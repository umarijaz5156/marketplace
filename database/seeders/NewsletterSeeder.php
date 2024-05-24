<?php

namespace Database\Seeders;

use App\Enums\EmailTemplateType;
use App\Models\Newsletter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class NewsletterSeeder extends Seeder
{
    private $body;

    public function __construct()
    {
        $this->body = '
        <p>{{seller}},</p>

        <p>{{user}},</p>
        <p>{{email}},</p>
        <p>{{service}},</p>

        <p>{{order_amount}},</p>

        <p>{{order_id}}</p>
        ';
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('newsletters')->truncate();
        Schema::enableForeignKeyConstraints();

        $Newsletter =[
            [
                'subject' => 'Your order has been placed',
                'body' => $this->body,
                'type' => EmailTemplateType::OrderPlacedBuyer->value,
            ],
            [
                'subject' => 'Seller has received new order',
                'body' => $this->body,
                'type' => EmailTemplateType::SellerOrderReceived->value,
            ],
            [
                'subject' => 'Order delivered (seller)',
                'body' => $this->body,
                'type' => EmailTemplateType::OrderDeliveredSeller->value,
            ],
            [
                'subject' => 'Order delivered (buyer)',
                'body' => $this->body,
                'type' => EmailTemplateType::OrderDeliveredBuyer->value,
            ],
            [
                'subject' => 'Order completed (seller)',
                'body' => $this->body,
                'type' => EmailTemplateType::OrderCompletedSeller->value,
            ],
            [
                'subject' => 'Order completed (buyer)',
                'body' => $this->body,
                'type' => EmailTemplateType::OrderCompletedBuyer->value,
            ],
            [
                'subject' => 'An order is requested modification',
                'body' => $this->body,
                'type' => EmailTemplateType::OrderModificationRequest->value,
            ],
            [
                'subject' => 'Order delayed',
                'body' => $this->body,
                'type' => EmailTemplateType::OrderDelayed->value,
            ],
            [
                'subject' => 'One day before order deadline to seller',
                'body' => $this->body,
                'type' => EmailTemplateType::ADayBeforeOrderDeadlineToSeller->value,
            ],
            [
                'subject' => 'When a review is pending on an order for 1 day',
                'body' => $this->body,
                'type' => EmailTemplateType::PendingReviewForADay->value,
            ],
            [
                'subject' => 'New user registered',
                'body' => $this->body,
                'type' => EmailTemplateType::UserRegistered->value,
            ],
            [
                'subject' => 'Seller registered',
                'body' => $this->body,
                'type' => EmailTemplateType::SellerRegistered->value,
            ],
            [
                'subject' => 'Seller approved',
                'body' => $this->body,
                'type' => EmailTemplateType::SellerApproved->value,
            ],
            [
                'subject' => 'Seller disapproved',
                'body' => $this->body,
                'type' => EmailTemplateType::SellerDisapproved->value,
            ],
            [
                'subject' => 'New conversation for gig',
                'body' => $this->body,
                'type' => EmailTemplateType::NewConversationGig->value,
            ],
            [
                'subject' => 'New conversation for order',
                'body' => $this->body,
                'type' => EmailTemplateType::NewConversationOrder->value,
            ],
            [
                'subject' => 'On a new reply',
                'body' => $this->body,
                'type' => EmailTemplateType::NewReply->value,
            ],
        ];

        DB::table('newsletters')->insert($Newsletter);
    }
}
