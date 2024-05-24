<?php

namespace App\Http\Livewire;

use App\Models\Order\Order;
use App\Models\User;
use Livewire\Component;

class OrderPlacedNotification extends Component
{
    // protected $listeners = ['echo:order-placed,OrderPlaced' => 'notifyNewOrder'];
    public function getListeners()
    {
      if(auth()->check()){
        if(auth()->user()->is_seller){
            $userId = auth()->user()->seller->id;
        }else{
            $userId = auth()->user()->id;
        }
        return [
        "echo-private:users.{$userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'broadcastedUserNotificationReceived',
          "echo-private:sellers.{$userId},.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated" => 'broadcastedNotificationReceived',
          'refresh' => '$refresh',
        ];
      }

    }
    public function render()
    {

        return view('livewire.order-placed-notification');
    }

    public function notifyNewOrder($event)
    {

        $order = Order::where('id', $event['order']['id'])->first();

        $message = $event['message']  .$order->gig->gigDetail->title;
        $image = $order->gig->mainImage?->image_path;
        session()->flash('order-placed', $message);
        session()->flash('image' ,$image);
        session()->flash('slug', $order->gig->gigDetail->slug);
        session()->flash('date', $order->updated_at->diffForHumans());
    }

    public function broadcastedNotificationReceived()
    {
        $user = User::find(auth()->user()->id);

        // $user->setConnection('mysql');

        $notification = $user->seller->notifications()->latest()->limit(1)->first();

        $order = Order::where('id', $notification->data['order_id'])->first();
        $image = $order->gig?->mainImage?->image_path;
        session()->flash('order-placed', $notification->data['message']);
        session()->flash('image' ,$image);
        if($order->type == 'normal'){
            session()->flash('slug', $order->gig->gigDetail->slug);
        } else{
            session()->flash('slug', $order->offer->title);
        }
        session()->flash('date', $order->updated_at->diffForHumans());
        $this->dispatchBrowserEvent('playSound', ['message' =>  $notification->data['message'], 'subject' => 'New Notification']);
    }

    public function broadcastedUserNotificationReceived()
    {

        $user = User::find(auth()->user()->id);
        // $user->setConnection('mysql');

        $notification = $user->notifications()->latest()->limit(1)->first();
        $order = Order::where('id', $notification->data['order_id'])->first();
        $image = $order->gig?->mainImage?->image_path;
        session()->flash('order-placed', $notification->data['message']);
        session()->flash('image' ,$image);
        if($order->type == 'normal'){
            session()->flash('slug', $order->gig->gigDetail->slug);
        } else{
            session()->flash('slug', $order->offer->title);
        }
        session()->flash('date', $order->updated_at->diffForHumans());
        $this->dispatchBrowserEvent('playSound', ['message' =>  $notification->data['message'], 'subject' => 'New Notification']);
    }


}
