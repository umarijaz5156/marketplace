<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'package_name',
        'package_description',
        'price',
        'delivery_days'
    ];

    // one to many relation with gigs
    public function gig() {
        return $this->belongsTo(Gig::class);
    }

    public function services() {
        return $this->belongsToMany(GigService::class);
    }
}
