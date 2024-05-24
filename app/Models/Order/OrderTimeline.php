<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_by',
        'order_id',
        'status',
        'modifications',
        'file_path'
        
    ];

    public function attachments(){
        return $this->hasMany(OrderAttachment::class, 'timeline_id');
    }

    public function request(){
        return $this->hasOne(OrderRequest::class, 'timeline_id');
    }
}