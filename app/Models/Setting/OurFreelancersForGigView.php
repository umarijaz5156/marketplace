<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurFreelancersForGigView extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_rating',
        'seller_orders',
        'seller_reg_date',
        'limit'
    ];
}
