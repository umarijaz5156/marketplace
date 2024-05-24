<?php

namespace App\Models\ChatCenter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'is_reported',
        'blocked_by'
    ];

    public function chat() {
        return $this->belongsTo(Chat::class);
    }


}
