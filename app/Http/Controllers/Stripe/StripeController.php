<?php

namespace App\Http\Controllers\Stripe;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Stripe\StripeClient;
use App\Enums\OrderStatus;
use App\Models\Newsletter;
use App\Enums\PayoutStatus;
use App\Models\Order\Order;
use App\Models\StripeToken;
use App\Enums\PaymentStatus;
use Illuminate\Http\Request;
use App\Enums\TimelineStatus;
use App\Models\Seller\Seller;
use App\Models\Seller\GigStat;
use App\Models\ChatCenter\Chat;
use App\Enums\EmailTemplateType;
use App\Events\MessageNotif;
use App\Models\Seller\GigDetail;
use App\Models\Order\OrderDetail;
use App\Models\Seller\SellerStat;
use App\Models\Order\OrderTimeline;
use App\Notifications\OrderUpdated;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\AffiliateCommission;
use App\Models\AffiliateConfig;
use App\Models\AffiliateUsers;
use App\Models\Offer;
use App\Models\Setting\RevenueConfiguration;

class StripeController extends Controller
{
    protected StripeClient $stripeClient;
    protected $FIXED_FEE = 0.30;
    protected $PERCENT_FEE =  2.9;
    protected $FIXED_COMMISSION = 5;


    public function __construct(StripeClient $stripeClient)
    {
        $this->stripeClient = $stripeClient;
    }

    public function redirectToStripe(Seller $seller)
    {
        if (is_null($seller->stripe_connect_id)) {
            $token = $seller->addToken();

            $account = $this->stripeClient->accounts->create([
                'country' => 'US',
                'type' => 'express',
                'email' => $seller->user->email,
                // 'tos_acceptance' => [
                //     'service_agreement' => 'recipient'
                // ],
                'capabilities' => [
                    'transfers' => [
                        'requested' => true,
                    ],
                    'card_payments' => [
                        'requested' => true,
                    ],
                ],
                'business_type' => 'individual',
                'individual' => [
                    'email' => $seller->user->email,
                    'first_name' => $seller->first_name,
                    'last_name' => $seller->last_name,
                ],
                'settings' => [
                    'payouts' => [
                        'schedule' => [
                            'interval' => 'manual'
                        ]
                    ]
                ],
                'default_currency' => 'USD'

            ]);

            $seller->update(['stripe_connect_id' => $account->id]);
            $seller->fresh();
        }

        $token = $seller->stripeToken;

        $onBoardLink = $this->stripeClient->accountLinks->create([
            'account' => $seller->stripe_connect_id,
            'refresh_url' => route('stripe.redirect', ['seller' => $seller]),
            'return_url' => route('stripe.connect', ['token' => $token->token]),
            'type' => 'account_onboarding'
        ]);

        return redirect()->away($onBoardLink->url)->send();
    }


    public function connectStripe($token)
    {
        $stripeToken = StripeToken::where('token', $token)->first();
        $seller = $stripeToken->seller;
        $seller->update([
            'stripe_onboarded' => true,
        ]);

        return redirect()->route('seller.earnings')->with('message', 'Connected to stripe successfully');
    }

    public function fetchPaymentIntent(Order $order)
    {
        $paymentIntent = $order->paymentIntent;

        // create payment intent
        if (!$order->paymentIntent) {
            $fee = $this->calculateStripeFee($order->orderDetails->amount);

            $paymentIntent = $this->stripeClient->paymentIntents->create([
                'amount' => self::stripeFormat($order->orderDetails->amount) + self::stripeFormat($fee),
                'currency' => 'USD',
                'description' => 'Order# ' . $order->id .' for seller '. $order->seller->user->email,
                'payment_method_types' => ['card'],
                'metadata' => [
                    'seller' => $order->seller->user->email,
                    'buyer' => $order->buyer->email,
                ]
                // 'transfer_data' => [
                //     'amount' => self::stripeFormat($order->orderDetails->total),
                //     'destination' => $order->seller->stripe_connect_id,
                // ],

            ]);

            $order->savePaymentIntent($paymentIntent->client_secret, $paymentIntent->id);

            $output = $paymentIntent->client_secret;
        } else {
            $output =  $paymentIntent->client_secret;
        }
        return $output;
    }

    public function checkoutForm(Order $order)
    {
        $clientKey = self::fetchPaymentIntent($order);
        $fee = $this->calculateStripeFee($order->orderDetails->amount);
        return View('components.stripe.checkout-form', [
            'clientKey' => $clientKey,
            'order' => $order,
            'fee' =>  round($fee, 2),
        ]);
    }

    public function successPayment(Order $order)
    {
        $order->update([
            'status' => OrderStatus::InProgress->value
        ]);
        $message = "New order #" . $order->id . " has been placed";
        $order->seller->notify(new OrderUpdated($order, OrderStatus::InProgress, $message));
        $order->updatePayment(1);
        $order->updatePayout(1);
        // create auto chat
        $chat = Chat::where('content_id', $order->id)->where('content_type', 'Order')->first();
        $seller = Seller::where('id', $order->seller_id)->first('user_id');
        if (!$chat) {
            Chat::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $seller->user_id,
                'content_type' => 'Order',
                'content_id' => $order->id,
                'last_reply_at' => Carbon::now(),
            ]);
        }

        // updated seller analytics
        $sellerStat = SellerStat::where('seller_id', $order->seller_id)->first();
        if ($sellerStat) {
            $sellerStat->total_orders += 1;
        }
        $sellerStat->save();

        // update gig stats;
        if($order->type == 'normal'){
            $order->gig->gigStat()->increment('order_count');
        } else{
            Offer::find($order->offer_id)->update([
                'status' => 'accepted'
            ]);
        }

        // add affiliate commission
        $affiliateUser = AffiliateUsers::where('user_id', auth()->user()->id)->first();
        if($affiliateUser && $affiliateUser->affiliate?->is_affiliate){
            $commission = AffiliateConfig::where('title', 'commission')->first()->value;
            $totalCommission = ($order->orderDetails->amount / 100) * $commission;
            $affiliateUser->update([
                'commission' => $affiliateUser->commission + $totalCommission
            ]);

            AffiliateCommission::create([
                'commission' => $totalCommission,
                'order_id' => $order->id,
                'affiliate_user_id' => $affiliateUser->id
            ]);
        }

        // send order placed email to user
        $this->sendMailOrderPlaced($order);
        if($order->type == 'offer'){
            $offer = Offer::find($order->offer_id);
            if($offer){
                $offer->request?->update([
                    'status' => 'inactive'
                ]);
            }
            $chat = Chat::where('content_type', 'order')->where('content_id', $order->id)->first(['id']);
            $response = [
                'type' => 'chat',
                'id' => $chat->id
            ];

            $data['subject'] = 'Offer Accpeted By Buyer';
            $data['body'] = 'Your Offer has been accepted by buyer, you can start working now';
            $mail_to = $offer->sender;
            $url = route('order_details', $order->id);
            dispatch(new SendEmailJob($data, $mail_to , $url));
        } else{
            $response = [
                'type' => 'order',
                'id' => $order->id
            ];
        }
        // broadcast(new MessageNotif(auth()->user(), $order->seller->user, $message));

        return response()->json($response);
    }

    public function withdraw(Request $request)
    {
        try{
            $account = $this->stripeClient->accounts->retrieve(auth()->user()->seller->stripe_connect_id);
        }
        catch(Exception $e){
            return back()->with('error', 'Payout Failed!');
        }


        if(auth()->user()->seller->stripe_onboarded && auth()->user()->seller->stripe_connect_id){

            $balance = $this->stripeClient->balance->retrieve(
                array(),
                array(
                    'stripe_account' =>  auth()->user()->seller->stripe_connect_id,
                )
            );
            $availableWithdraw = 0;
            foreach ($balance->available as $availableBalance) {
                $availableWithdraw += ($availableBalance->amount / 100);
            }

            if ($request['amount'] > 0 && $request['amount'] <= $availableWithdraw) {
                $payout = $this->stripeClient->payouts->create([
                    'amount' => self::stripeFormat($request['amount']),
                    'currency' => 'USD',

                ], [
                    'stripe_account' => auth()->user()->seller->stripe_connect_id,
                ]);

                return back()->with('success', 'A new payout of $' . $request['amount'] . ' created.');
            }
         }
        return back()->with('error', 'Payout Failed!');
    }

    public function transferToConnectAccount(Order $order)
    {
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

                        $response = [
                            'transfered' => false,
                        ];
                        error_log("A payment error occurred: {$e->getError()->message}");
                        return response()->json($response);
                    } catch (\Stripe\Exception\InvalidRequestException $e) {

                        $response = [
                            'transfered' => false,
                        ];
                        error_log("An invalid request occurred.");
                        return response()->json($response);
                    } catch (Exception $e) {
                        $response = [
                            'transfered' => false,
                        ];
                        error_log("Another problem occurred, maybe unrelated to Stripe.");
                        return response()->json($response);
                    }

                    $order->updatePayout(PayoutStatus::Paid->value);
                    $order->update(['status' => OrderStatus::Completed->value, 'solved_by' => auth()->user()->id]);


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
                    $response = [
                        'transfered' => true,
                    ];
                } else{
                    $order->update(['status' => OrderStatus::Completed->value, 'solved_by' => auth()->user()->id]);
                    $message = 'Connect you stripe account to get payment for  order#'.$order->id;
                    $url = route('seller-dashboard');
                    dispatch(new \App\Jobs\SendOrderMailJob($message, $order->seller?->user?->email, $url));
                    $response = [
                        'transfered' => true,
                    ];
                }

            } else {

                $response = [
                    'transfered' => false,
                ];
            }
        } else {

            $response = [
                'transfered' => false,
            ];
        }

        return response()->json($response);
    }

    public function refund(Order $order)
    {

        if ($order->payout->status == PayoutStatus::Pending->value) {
            if ($order->paymentIntent->status == PaymentStatus::PAID->value) {
                $refundCommission = RevenueConfiguration::where('id', 1)->first('refund_commission');
                $refundCommission = ($order->paymentIntent->amount / 100) * $refundCommission->refund_commission;
                $refundAmount = $order->paymentIntent->amount - $refundCommission;
                $refundAmount =  self::stripeFormat($refundAmount);
                $refund = $this->stripeClient->refunds->create([
                    'amount' => $refundAmount,
                    'payment_intent' => $order->paymentIntent->payment_intent,
                ]);
                $order->updatePayout(PayoutStatus::Refunded->value);
                $order->update(['status' => OrderStatus::Cancelled->value]);


                $response = [
                    'refunded' => true,
                ];
            }
        } else {
            $response = [
                'refunded' => false,
            ];
        }
        return response()->json($response);
    }

    public function cancel(Order $order)
    {

        if ($order->payout->status == PayoutStatus::Pending->value) {
            if ($order->paymentIntent->status == PaymentStatus::PAID->value) {
                $refundCommission = RevenueConfiguration::where('id', 1)->first('refund_commission');
                $refundCommission = ($order->paymentIntent->amount / 100) * $refundCommission->refund_commission;
                $refundAmount = $order->paymentIntent->amount - $refundCommission;
                $refundAmount =  self::stripeFormat($refundAmount);
                $refund = $this->stripeClient->refunds->create([
                    'amount' => $refundAmount,
                    'payment_intent' => $order->paymentIntent->payment_intent,
                ]);
                $order->updatePayout(PayoutStatus::Refunded->value);
                $order->update(['status' => OrderStatus::Cancelled->value]);


                // update gig stats
                GigStat::where('gig_id', $order->gig_id)->increment('order_cancelled');

                // udpate seller stats
                SellerStat::where('seller_id', $order->seller_id)->increment('orders_canceled');


                // OrderTimeline::create([
                //     'order_id' => $order->id,
                //     'status' => TimelineStatus::Cancelled->value,
                // ]);

                $response = [
                    'refunded' => true,
                ];
            } elseif ($order->paymentIntent->status == PaymentStatus::UNPAID->value) {
                $this->stripeClient->paymentIntents->cancel(
                    $order->paymentIntent->payment_intent,
                    []
                );
                $order->update(['status' => OrderStatus::Cancelled->value]);
                $response = [
                    'refunded' => true,
                ];
            }

            // notify user and seller
            $order->buyer->notify(new OrderUpdated($order, OrderStatus::Cancelled));
            $order->seller->notify(new OrderUpdated($order, OrderStatus::Cancelled));
        } else {
            $response = [
                'refunded' => false,
            ];
        }

        return response()->json($response);
    }

    protected static function stripeFormat($amount)
    {
        $amount = round($amount, 2);
        return $amount * 100;
    }

    protected function calculateStripeFee($amount)
    {
        // $total = ($amount + $this->FIXED_FEE) / (1 - ($this->PERCENT_FEE / 100));
        // get 5 percent commission
        $total = ($amount/100) * $this->FIXED_COMMISSION;
        // $fee = $total - $amount;
        return $total;
    }

    public function sendMailOrderPlaced($order)
    {
        $order = $order->load(['seller', 'orderDetails']);

        // send email to buyer
        if ($order_placed_data = Newsletter::where('type', EmailTemplateType::OrderPlacedBuyer->value)->first()) {
            $subject = $order_placed_data->subject;
            $body = $order_placed_data->body;

            $body = str_replace('{{order_id}}', $order->id, $body);
            if($order->type == 'normal'){
                $body = str_replace('{{service}}', GigDetail::where('gig_id', $order->gig_id)->first()->title, $body, $body);
            } else{
                $body = str_replace('{{service}}', Offer::find($order->offer_id)->title, $body, $body);
            }

            $body = str_replace('{{order_amount}}', $order->orderDetails->amount, $body);
            $body = str_replace('{{user}}', auth()->user()->name, $body);
            $body = str_replace('{{seller}}', $order->seller->seller_name, $body);
            $body = str_replace('{{email}}', auth()->user()->email, $body);
            $data = ['subject' => $subject, 'body' => $body];

            $data = ['subject' => $subject, 'body' => $body];
            $url = route('buyerorder_details', ['id' => $order->id]);
            dispatch(new \App\Jobs\SendOrderMailJob($data, auth()->user()->email, $url));
        }

        // send email to seller
        if ($seller_received_order = Newsletter::where('type', EmailTemplateType::SellerOrderReceived->value)->first()) {
            $subject = $seller_received_order->subject;
            $body = $seller_received_order->body;

            $body = str_replace('{{order_id}}', $order->id, $body);
            if($order->type == 'normal'){
                $body = str_replace('{{service}}', GigDetail::where('gig_id', $order->gig_id)->first()->title, $body, $body);
            } else{
                $body = str_replace('{{service}}', Offer::find($order->offer_id)->title, $body, $body);
            }

            $body = str_replace('{{order_amount}}', $order->orderDetails->total, $body);
            $body = str_replace('{{seller}}', $order->seller->seller_name, $body);
            $body = str_replace('{{user}}', $order->seller->user?->name, $body);
            $data = ['subject' => $subject, 'body' => $body];
            $url = route('order_details', ['id' => $order->id]);
            $seller_user_id = $order->seller->user_id;
            if ($user = User::find($seller_user_id)) {
                dispatch(new \App\Jobs\SendOrderMailJob($data, $user->email, $url));
            }
        }
    }
}
