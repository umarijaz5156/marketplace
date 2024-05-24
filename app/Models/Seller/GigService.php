<?php

namespace App\Models\Seller;

use App\Models\Seller\Gig;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function gigs() {
        return $this->belongsToMany(Gig::class);
    }

    public function gigPackages()
    {
        return $this->belongsToMany(GigPackage::class);
    }

}
