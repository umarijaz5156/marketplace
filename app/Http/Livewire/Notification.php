<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;


class Notification extends Component
{

    public $notifications;
    public $user;

    public function getListeners()
    {
      if(auth()->check()){
        $userId = auth()->user()->id;
        return [
          "echo-private:users.{$userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'broadcastedNotificationReceived',
          'refresh' => '$refresh',
        ];
      }

    }

    public function render()
    {
        $this->user = User::find(auth()->user()->id);
        // $this->user->setConnection('mysql');
        $this->notifications = $this->user->notifications;

        return view('livewire.notification');
    }

    public function readNotification($notification)
    {
      if(!isset($notification['read_at'])){
        auth()->user()->unreadNotifications()->find($notification['id'])->update(['read_at' => now()]);
      }

        return redirect(route('buyerorder_details', ['id' => $notification['data']['order_id']]));
    }

    public function broadcastedNotificationReceived($event)
    {
      $this->emitSelf('refresh');
    }
}
