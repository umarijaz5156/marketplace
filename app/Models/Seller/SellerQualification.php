<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerQualification extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $guarded = [];
}
