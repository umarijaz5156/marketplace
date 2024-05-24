<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderRequest extends Model
{

    use HasFactory;

    protected $fillable = [
        'order_id',
        'subject',
        'days',
        'status',
        'type',
        'timeline_id'
    ];
}