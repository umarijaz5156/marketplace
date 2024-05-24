<?php

namespace App\Http\Livewire\Seller;

use App\Models\ChatCenter\ChatMessage;
use Livewire\Component;

class SellerSideNavbar extends Component
{

    public $newMessage;

    public function getListeners()
    {

        $auth_id = auth()->user()->id;
        return [
            // "echo-private:chatSent.{$auth_id},MessageSent"=>'broadcastedMessageNotification',
            // 'messageReceived' => 'broadcastedMessageNotification',
            'messageRead', 'refresh' => '$refresh'
        ];
    }


    public function render()
    {
        if(auth()->check()){
            $this->getUnreadMessages();
        }

        return view('livewire.seller.seller-side-navbar');
    }


    public function broadcastedMessageNotification()
    {
        $this->newMessage = true;
        // $this->dispatchBrowserEvent('playSound', ['message' => 'You have Received a new message', 'subject' => 'New Message']);
    }


    public function messageRead()
    {

        $this->getUnreadMessages();
    }

    public function getUnreadMessages()
    {
        $unreadMessages = ChatMessage::where('is_seen', false)->where('receiver_id',auth()->user()->id)->count();

        if($unreadMessages > 0) {
            $this->newMessage = true;
        } else{
            $this->newMessage = false;
        }
        // $this->emitSelf('refresh');
    }
}
