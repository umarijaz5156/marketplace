<?php

namespace App\Models\ChatCenter;

use App\Models\ChatDocument;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'sender_id',
        'receiver_id',
        'chat_id',
        'sent_at',
        'contains_spam',
        'is_seen',
        'sent_by',
        'type'
    ];

    protected $date = [
        'created_at',
        'updated_at',
        'sent_at',
    ];

    public function chat() {
        return $this->belongsTo(Chat::class);
    }

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function attachments() {
        return $this->hasMany(ChatDocument::class);
    }

    public function offer(){
        return $this->hasOne(Offer::class, 'message_id');
    }
}
