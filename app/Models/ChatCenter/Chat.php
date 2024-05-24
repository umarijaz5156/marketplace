<?php

namespace App\Models\ChatCenter;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
protected $connection = 'mysql';
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'last_reply_at',
        'content_type',
        'content_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_reply_at'
    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function chatMessages() {
        return $this->hasMany(ChatMessage::class);
    }

    public function chatStatus() {
        return $this->hasOne(ChatStatus::class);
    }

}
