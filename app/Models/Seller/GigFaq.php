<?php

namespace App\Models\Seller;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GigFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
    ];
}
