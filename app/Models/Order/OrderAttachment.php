<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'attachment_path',
        'added_by',
        'is_delivery',
        'details',
        'timeline_id'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
