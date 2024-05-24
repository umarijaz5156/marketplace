<?php

namespace App\Models;

use App\Models\Seller\Gig;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $fillable = [
        'from_user_id',
        'order_id',
        'gig_id',
        'to_user_id',
        'rating',
        'review',
        'review_type',
        'is_approved',
        'created_at'
    ];

    // review sent by user
    public function sentByUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    // received by user
    public function receivedbyUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }

}
