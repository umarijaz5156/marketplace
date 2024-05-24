<?php


namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SellerStat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'money_earned',
        'total_orders',
        'orders_completed',
        'orders_canceled',
        'total_reviews',
        'reviews_average',
        'response_rate'
    ];

    protected function moneyEarned() : Attribute {
        return Attribute::make(
            get: fn($value) => floatval($value),
        );
    }

    // relation with seller
    public function seller() {
        return $this->belongsTo(Seller::class);
    }

}