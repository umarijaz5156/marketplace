<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'total',
        'commission',
        'gig_package_id',
        'delivery_time',
        'buyer_requirements',
        'timeline_id'
    ];

    protected $dates = [
        'delivery_time',
        'created_at',
        'updated_at',
    ];

    protected function amount() : Attribute {
        return Attribute::make(
            get: fn($value) => floatval($value),
        );
    }

    protected function buyerRequirements() : Attribute {
     
        return Attribute::make(
            get: fn($value) => json_decode($value),
            set: fn($value) => json_encode($value)
        );
    
    }


    
    public function order() {
        return $this->belongsTo(Order::class);
    }
}
