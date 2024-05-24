<?php

namespace App\Http\Livewire;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MessageNotification extends Component
{
    use LivewireAlert;

    public $showNotif = false;
    public $message;

    public function getListeners()
    {
        if(auth()->check()){
            $auth_id = auth()->user()->id;
            return [
                "echo-private:message-notif.{$auth_id},MessageNotif"=>'notifyNewMessage',
            ];
        }

    }

    public function render()
    {
        return view('livewire.message-notification');
    }

    public function notifyNewMessage($event)
    {
        $this->dispatchBrowserEvent('playSound', ['message' => 'You have Received a new message', 'subject' => 'New Message']);
        $user = User::where('id', $event['user_id'])->first();
        $message = "New message recieved from ".$user?->name;
        // $message = is_null($event['message']) ? $event['message'] : "New message recieved from ".$user->name;
        $this->alert('info', $message, [
        'position' => 'bottom-start',
        'timer' => 6000,
        'toast' => true,
       ]);
    }


}
