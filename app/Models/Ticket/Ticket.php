<?php

namespace App\Models\Ticket;

use App\Models\Order\Order;
use App\Models\Seller\Seller;
use App\Models\TicketChat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
protected $connection = 'mysql';
    protected $fillable = [
        'order_id',
        'buyer_id',
        'seller_id',
        'ticket_manager_id',
        'ticket_winner',
        'subject',
        'created_by'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'ticket_manager_id');
    }

    public function ticketChat()
    {
        return $this->hasMany(TicketChat::class);
    }


}
