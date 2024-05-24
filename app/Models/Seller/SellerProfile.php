<?php

namespace App\Models\Seller;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'description',
        'address_line1',
        'address_line2',
        'country_id',
        'phone',
        'seller_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
