<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'requirement'
    ];

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }
}
