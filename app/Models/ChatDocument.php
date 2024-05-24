<?php

namespace App\Models;

use App\Models\ChatCenter\ChatMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatDocument extends Model
{
    use HasFactory;

    protected $fillable = ['chat_documment_id', 'name', 'file_url', 'file_type'];

    protected function message()
    {
        return $this->belongsTo(ChatMessage::class);
    }
}
