<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_count',
        'orders_cancelled',
        'orders_completed',
        'reviews_count',
        'reviews_average',
        'money_earned'
    ];


    // one to one relation with gig
    public function gig() {
        return $this->belongsTo(Gig::class);
    }
}
