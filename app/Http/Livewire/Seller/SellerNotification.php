<?php

namespace App\Http\Livewire\Seller;

use App\Models\User;
use Livewire\Component;

class SellerNotification extends Component
{
    public $notifications;

    public function getListeners()
    {
      if(auth()->check()){
        $userId = auth()->user()->seller->id;
        return [
          "echo-private:sellers.{$userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'broadcastedNotificationReceived',
          'refresh' => '$refresh',
        ];
      }

    }

    public function render()
    {
        $user = User::find(auth()->user()->id);
        // $user->setConnection('mysql');
        $this->notifications = $user->seller->notifications;
        $this->notifications->merge( $user->notifications);
        $this->notifications->sortBy('created_at');
        return view('livewire.seller.seller-notification');
    }

    public function readNotification($notification)
    {
      if(!isset($notification['read_at'])){
        auth()->user()->seller->unreadNotifications()->find($notification['id'])->update(['read_at' => now()]);
      }

        return redirect(route('order_details', ['id' => $notification['data']['order_id']]));
    }

    public function broadcastedNotificationReceived($event)
    {
      $this->emitSelf('refresh');
    }
}
