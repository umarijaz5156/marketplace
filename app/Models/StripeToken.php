<?php

namespace App\Models;

use App\Models\Seller\Seller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StripeToken extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function seller()
    {
       return $this->belongsTo(Seller::class); 
    }
}