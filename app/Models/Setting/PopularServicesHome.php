<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopularServicesHome extends Model
{
    use HasFactory;

    protected $fillable =[
        'seller_rating',
        'gig_rating',
        'gig_orders',
        'seller_orders',
        'seller_reg_date',
        'gig_add_date',
        'limit',
        'status'
    ];
}
