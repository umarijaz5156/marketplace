<?php

namespace App\Console\Commands;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\PayoutStatus;
use App\Models\MiscConfig;
use App\Models\Order\Order;
use App\Models\Seller\GigStat;
use App\Models\Seller\SellerStat;
use App\Models\User;
use App\Notifications\OrderUpdated;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Stripe\StripeClient;

class CompleteOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Complete order after x days';


    protected $stripeClient;
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->stripeClient =  App::make(StripeClient::class);
        $miscConfig = MiscConfig::where('name', 'order_complete')->first();
        $days = isset($miscConfig->value) ? $miscConfig->value : null;
        if($days){

            $orders = Order::join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
            ->join('order_timelines as o_t', function($join){
                $join->on('o_t.order_id', '=', 'orders.id')
                ->where('o_t.status', 'Delivered')
                ->whereDate('o_t.created_at', Carbon::now()->subDays(3));
            })
            ->select('orders.id', 'orders.user_id', 'orders.seller_id', 'orders.gig_id', 'o_d.amount', 'o_d.total')
            ->where('orders.status', OrderStatus::Delivered->value)

            ->get();
            foreach($orders as $order){
                $this->completeOrder($order);
            }
        }

        return Command::SUCCESS;
    }

    protected function completeOrder($order){
        if ($order->payout->status == PayoutStatus::Pending->value) {

            $paymentIntent = $this->stripeClient->paymentIntents->retrieve($order->paymentIntent->payment_intent);
            $charge_id = $paymentIntent->charges->first()->id;
            if ($order->paymentIntent->status == PaymentStatus::PAID->value) {
                if( $order->seller->stripe_onboarded && isset($order->seller->stripe_connect_id))
                {
                    try {
                       $this->stripeClient->transfers->create([
                            "amount" => self::stripeFormat($order->payout->amount),
                            "currency" => "usd",
                            "description" => "Order #" . $order->id,
                            "destination" => $order->seller->stripe_connect_id,
                            "source_transaction" => $charge_id,
                        ]);

                    } catch (\Stripe\Exception\CardException $e) {


                        error_log("A payment error occurred: {$e->getError()->message}");
                        return false;
                    } catch (\Stripe\Exception\InvalidRequestException $e) {


                        error_log("An invalid request occurred.");
                       return false;
                    } catch (Exception $e) {

                        error_log("Another problem occurred, maybe unrelated to Stripe.");
                        return false;
                    ;
                    }

                    $order->updatePayout(PayoutStatus::Paid->value);
                    $admin = User::where('is_admin', true)->first('id');
                    $order->update(['status' => OrderStatus::Completed->value, 'solved_by' => $admin->id]);


                        $stats = SellerStat::where('seller_id', $order->seller_id)->first();
                        // $order = OrderDetail::where('order_id', $order->id)->first('total');

                        $stats->orders_completed += 1;
                        $stats->money_earned += $order->payout->amount;
                        $stats->save();



                    // update gig stats
                    if($order->status == 'normal'){
                        $gigStats = GigStat::where('gig_id', $order->gig_id)->first();
                        $gigStats->order_completed += 1;
                        $gigStats->money_earned += $order->payout->amount;
                        $gigStats->save();
                    }
                    // send nofiticaions tp seller

                    $order->seller->notify(new OrderUpdated($order, OrderStatus::Completed));
                   return true;
                } else{
                    $admin = User::where('is_admin', true)->first('id');
                    $order->update(['status' => OrderStatus::Completed->value, 'solved_by' => $admin->id]);
                    $message = 'Connect you stripe account to get payment for  order#'.$order->id;
                    $url = route('seller-dashboard');
                    dispatch(new \App\Jobs\SendOrderMailJob($message, $order->seller?->user?->email, $url));
                  return true;
                }

            } else {

                return false;
            }
        } else {

            return false;
        }
    }
}
