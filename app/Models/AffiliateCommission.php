<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateCommission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function affiliate()
    {
        return $this->belongsTo(AffiliateUsers::class);
    }
}
