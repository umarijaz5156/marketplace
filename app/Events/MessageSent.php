<?php

namespace App\Events;

use App\Models\ChatCenter\Chat;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use App\Models\ChatCenter\ChatMessage;
use Error;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $user;
    public $message;
    public $chat;
    public $receiver;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user,ChatMessage $message,Chat $chat,User $receiver)
    {

        $this->user = $user;
        $this->message = $message;
        $this->chat = $chat;
        $this->receiver = $receiver;
    }

    public function broadcastWith()
    {
        return [
            'user_id' => $this->user->id,
            'message_id' => $this->message->id,
            'chat_id' => $this->chat->id,
            'receiver_id' => $this->receiver->id,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chatSent.'.$this->receiver->id);
    }
}
