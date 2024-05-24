<?php

namespace App\Console\Commands;

use App\Enums\EmailTemplateType;
use App\Enums\OrderStatus;
use App\Mail\Order\OrderDeadlineToSellerMail;
use App\Mail\Order\OrderMail;
use App\Models\Newsletter;
use App\Models\Order\Order;
use App\Models\Seller\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PendingReview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:pending-reviews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'When a review is pending on an order for 1 day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
                        ->leftJoin('reviews', function($join){
                            $join->on('orders.id', '=','reviews.order_id');
                        })
                        ->select('orders.id')
                        ->havingRaw('COUNT(reviews.order_id) < 2')
                        ->where('orders.status', OrderStatus::Completed->value)
                        ->whereDate('o_d.delivery_time', Carbon::now()->addDay())
                        ->groupBy('reviews.order_id', 'orders.id')
                        ->pluck('orders.id')
                        ->toArray();

        // Log::info($orders);
        $ordersPendingReviews = Order::join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
                                        ->join('gigs', 'gigs.id', '=', 'orders.gig_id')
                                        ->join('gig_details as g_d', 'g_d.gig_id', '=', 'gigs.id')
                                        ->leftJoin('reviews', 'reviews.order_id', '=', 'orders.id')
                                        ->select(
                                            'orders.id', 'orders.user_id', 'orders.seller_id',
                                            'o_d.amount', 'o_d.total',
                                            'g_d.title as gig_title'
                                        )
                                        ->where(function($query){
                                            $query->whereNull('reviews.id')
                                            ->orWhere('reviews.review_type', '!=', 'buyer');
                                        })
                                        ->whereIn('orders.id', $orders)
                                        ->get();

        // Log::info($ordersPendingReviews);
        if($mailData = Newsletter::where('type', EmailTemplateType::PendingReviewForADay->value)->first()){
            $body = $mailData->body;

            foreach($ordersPendingReviews as $order){
                $seller = Seller::find($order->seller_id);
                $user = User::find($order->user_id);

                $mailBody = str_replace('{{seller}}', $seller->seller_name, $body);
                $mailBody = str_replace('{{user}}', $user->name, $mailBody);
                $mailBody = str_replace('{{service}}', $order->gig_title, $mailBody);
                $mailBody = str_replace('{{order_id}}', $order->id, $mailBody);
                $mailBody = str_replace('{{order_amount}}', $order->amount, $mailBody);

                $data = ['body' => $mailBody, 'subject' => $mailData->subject];

                $to = $user->email;

                Mail::to($to)->send(new OrderDeadlineToSellerMail($data));
            }
        }



        return Command::SUCCESS;
    }
}
