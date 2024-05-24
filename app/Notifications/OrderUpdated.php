<?php

namespace App\Notifications;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderUpdated extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public $order;
    public $status;
    public $message;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, OrderStatus $status, $message = null)
    {

        $this->order = $order;
        $this->status = $status->value;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
            return [
                'order_id' => $this->order->id,
                'message' => isset($this->message) ? $this->message : "Your order #".$this->order->id.' status has been changed to '.$this->status,
            ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable){

        return new BroadcastMessage([
            'order_id' => $this->order->id,
        ]);
    }

    // /**
    //  * Get the type of the notification being broadcast.
    //  *
    //  * @return string
    //  */
    // public function broadcastType()
    // {
    //     return 'private';
    // }


}
