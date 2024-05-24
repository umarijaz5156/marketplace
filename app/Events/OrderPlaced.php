<?php

namespace App\Events;

use App\Models\Order\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Order $order, $message)
    {
        $this->order = $order;
        $this->message = $message;
    }

    public function broadcastWith()
    {
        return [
            'order' => $this->order,
            'message' => $this->message
        ];
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() : Channel
    {

        return new Channel('order-placed');
    }
}
