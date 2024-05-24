<?php

namespace App\Models\Order;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\PayoutStatus;
use App\Models\Offer;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Seller\Gig;
use App\Models\Seller\Seller;
use App\Models\Seller\SellerPayout;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'gig_id',
        'user_id',
        'seller_id',
        'has_attachment',
        'status',
        'solved_by',
        'type',
        'offer_id'
    ];


    public function savePaymentIntent($clientSecret, $paymentIntent)
    {
        $payment = Payment::create([
            'order_id' => $this->id,
            'user_id' => $this->user_id,
            'amount' => $this->orderDetails->amount,
            'client_secret' => $clientSecret,
            'payment_intent' => $paymentIntent,
            'status' => PaymentStatus::UNPAID->value
        ]);

        $this->createPayout($payment->id);
    }

    public function updatePayment($status)
    {
        $payment = $this->paymentIntent;
        $payment->update([
            'status' => $status
        ]);

        return true;
    }

    public function createPayout($paymentId)
    {
        SellerPayout::create([
            'order_id' => $this->id,
            'seller_id' =>$this->seller_id,
            'payment_id' => $paymentId,
            'amount' => $this->orderDetails->total,
            'status' => 0,
        ]);
    }

    public function updatePayout($status)
    {
        $payout = $this->payout;
        $payout->update(['status' => $status]);
        return true;
    }



    public function payout()
    {
        return $this->hasOne(SellerPayout::class);
    }


    public function paymentIntent()
    {
        return $this->hasOne(Payment::class);
    }

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }

    public function orderDetails() {
        return $this->hasOne(OrderDetail::class);
    }

    public function orderAttachments() {
        return $this->hasMany(OrderAttachment::class);
    }

    public function orderReviews() {
        return $this->hasMany(Review::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function seller() {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

   public function requests() {
        return $this->hasMany(OrderRequest::class)->latest()->limit(1);
   }

   public function timeline() {
        return $this->hasMany(OrderTimeline::class)->latest();
   }

   public function buyer() {
        return $this->belongsTo(User::class, 'user_id');
   }

   public function offer(){
        return $this->belongsTo(Offer::class, 'offer_id');
   }

    public function statusColor()
    {
        switch ($this->status) {
            case OrderStatus::Cancelled->value:
                return 'red';
                break;

            case OrderStatus::Pending->value:
                return 'yellow';
                break;

            case OrderStatus::Disputed->value:
                return 'pink';
                break;

            case OrderStatus::Completed->value:
                return 'green';
                break;

            case OrderStatus::Delivered->value:
                return 'purple';
                break;

            // case OrderStatus::Refunded->value:
            //     return 'gray';
            //     break;

            default:
                return 'blue';
                break;
        }
    }
}
