<?php

namespace App\Console\Commands;

use App\Enums\EmailTemplateType;
use App\Enums\OrderStatus;
use App\Mail\Order\OrderMail;
use App\Models\Newsletter;
use App\Models\Order\Order;
use App\Models\Seller\GigDetail;
use App\Models\Seller\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class OrderDelayed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:delayed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Order Delayed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
                        ->select('orders.id', 'orders.user_id', 'orders.seller_id', 'orders.gig_id', 'o_d.amount', 'o_d.total')
                        ->where('status', OrderStatus::Pending->value)
                        ->whereDate('o_d.delivery_time', Carbon::now()->subDay())
                        ->get();

        if($mailData = Newsletter::where('type', EmailTemplateType::OrderDelayed->value)->first()) {
            foreach ($orders as $order) {
                $this->sendMail($mailData, $order);
            }
        }

        return Command::SUCCESS;
    }

    public function sendMail($mailData, $order)
    {
        $user = User::find($order->user_id);
        $seller = Seller::find($order->seller_id);

        $gig = GigDetail::where('gig_id', $order->gig_id)->first();

        $mailBody = str_replace('{{seller}}', $seller->seller_name, $mailData->body);
        $mailBody = str_replace('{{user}}', $user->name, $mailBody);
        $mailBody = str_replace('{{order_id}}', $order->id, $mailBody);
        $mailBody = str_replace('{{order_amount}}', $order->amount, $mailBody);
        $mailBody = str_replace('{{service}}', $gig->title, $mailBody);

        $data = ['body' => $mailBody, 'subject' => $mailData->subject];

        if($seller_user = User::find($seller->user_id)) {
            $to = $seller_user->email;

            Mail::to($to)->send(new OrderMail($data));
        }

        return 1;
    }
}
