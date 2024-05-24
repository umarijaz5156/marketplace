<?php

namespace App\Console\Commands;

use App\Enums\EmailTemplateType;
use App\Enums\OrderStatus;
use App\Mail\Order\OrderDeadlineToSellerMail;
use App\Models\Newsletter;
use App\Models\Order\Order;
use App\Models\Seller\GigDetail;
use App\Models\Seller\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ADayBeforeOrderDeadlineToSeller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:deadline-to-seller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '1 Day Before Order Deadline To Seller.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
                        ->whereDate('o_d.delivery_time', Carbon::now()->addDay())
                        ->select('orders.id', 'orders.seller_id', 'orders.user_id', 'orders.gig_id', 'o_d.amount', 'o_d.total')
                        ->get();

        if($mailData = Newsletter::where('type', EmailTemplateType::ADayBeforeOrderDeadlineToSeller->value)->first()){
            $body = $mailData->body;


            foreach($orders as $order){
                $seller = Seller::find($order->seller_id);
                $user = User::find($order->user_id);
                $gig = GigDetail::where('gig_id', $order->gig_id)->first();

                $mail_body = str_replace('{{seller}}', $seller->seller_name,$body);
                $mail_body = str_replace('{{user}}', $user->name, $mail_body);
                $mail_body = str_replace('{{service}}', $gig->title, $mail_body);
                $mail_body = str_replace('{{order_amount', $order->total, $mail_body);
                $mail_body = str_replace('{{order_id}}', $order->id, $mail_body);


                if($to = $seller->load('user')->user->email){

                    $data = ['body' => $mail_body, 'subject' => $mailData->subject];
                    Mail::to($to)->send(new OrderDeadlineToSellerMail($data));
                }
            }
        }

    }
}
