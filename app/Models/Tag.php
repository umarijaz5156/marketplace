<?php

namespace App\Models;

use App\Models\Seller\Gig;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Mutator to lower case the tag name
     */
    protected function name() : Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtolower($value) ,
        );
    }

    // many to many relation with gigs
    public function gigs() {
       return $this->belongsToMany(Gig::class);
    }
}
