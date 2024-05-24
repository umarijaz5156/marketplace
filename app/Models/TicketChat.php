<?php

namespace App\Models;

use App\Models\Ticket\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'sender_id',
        'message',
        'sender',
    ];

    public function ticket() {
        return $this->belongsTo(Ticket::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver1()
    {
        return $this->belongsTo(User::class, 'receiver_seller_id');
    }

    public function receiver2()
    {
        return $this->belongsTo(User::class, 'receiver_buyer_id');
    }
}
