<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigPortfolio extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }

}
