<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    // relation with gig
    public function gig() {
        return $this->belongsTo(Gig::class);
    }
}
