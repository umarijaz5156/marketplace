<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Events\UserStatus;
use App\Events\UserOffline;
use App\Models\ChatCenter\ChatMessage;
use Illuminate\Support\Facades\Auth;

class NewHeader extends Component
{
    public $type;
    public $count ;
    public $newMessage  ;

    public function getListeners()
    {
        if(auth()->check()){
            $userId = auth()->user()->id;
            return [

                // "echo-presence:chat-status,listen,here" => 'showOnline',
                // "echo-presence:chat-status,listen,joining" => 'showOnline',
                // "echo-presence:chat-status,listen,leaving" => 'hideOffline',
                // "echo.private:users.{$userId},.Illuminate\\Notifications\\Message\\BroadcastMessage" => 'broadcastedNotificationReceived',
                // 'messageReceived' => 'broadcastedMessageNotification',
                // "echo-private:chatSent.{$userId},MessageSent"=>'broadcastedMessageNotification',
                'messageRead',
                'refresh' => '$refresh',
                'logout' => 'showOffline',
                'login' => 'online'
            ];
        }

    }

    public function logout(){
        User::where('id', Auth::user()->id)->update([
            'is_online' => false
        ]);
    }
    public function showOffline(){

        if(Auth::check()){
            User::where('id', auth()->user()->id)->update([
                'is_online' => false
            ]);
        }

    }

    public function online(){
        if(Auth::check()){
            User::where('id', auth()->user()->id)->update([
                'is_online' => true
            ]);
        }
    }

    public function showOnline(User $user)
    {


        $user->is_online = true;
        $user->save();

        broadcast(new UserStatus($user));

    }

    public function hideOffline(User $user)
    {

        $user->is_online = false;
        $user->save();

        broadcast(new UserOffline($user));

    }

    public function render()
    {
        if(auth()->check()){
            $this->getUnreadMessages();
        }

        return view('livewire.new-header');
    }

    public function broadcastedMessageNotification()
    {

        $this->newMessage = true;
        // $this->dispatchBrowserEvent('playSound', ['message' => 'You have Received a new message', 'subject' => 'New Message']);
        $this->emitSelf('refresh');
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
    }
}
