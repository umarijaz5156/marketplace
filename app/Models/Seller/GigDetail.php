<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug'
    ];

    public function gig() {
        return $this->belongsTo(Gig::class);
    }
}
