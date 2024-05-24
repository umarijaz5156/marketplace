<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateUsers extends Model
{
    use HasFactory;
protected $connection = 'mysql';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function affiliate()
    {
        return $this->belongsTo(User::class, 'affiliate_id');
    }

    public function commissions()
    {
        return $this->hasMany(AffiliateCommission::class, 'affiliate_user_id');
    }
}
