<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Jobs\SendEmailJob;
use App\Models\Ticket\Ticket;
use App\Models\TicketChat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Chat extends Component
{
    public $ticketId;
    public $senderId;
    public $message;

    public function sendMessage() {
        $this->validate([
            'message' => 'required'
        ]);

        $ticket = Ticket::where('id',$this->ticketId)->first();

        $data = [
                    'ticket_id' => $ticket->id,
                    'message' => $this->message,
                    'sender_id' => auth()->user()->id
                ];

        TicketChat::create($data);
        $this->message = '';
        $this->dispatchBrowserEvent('gotoLastMessage', ['id' => 'chatBox']);
        $data = ['body' => 'New Reply Recieved on Ticket #'.$ticket->id. ' By Ticket Manager', 'subject' => 'New Reply Recieved on Ticket'];
        $order = $ticket->order;
        $mail_to = $order->seller?->user->email;
        $url = route('seller.dispute-details', ['id' => $ticket->id]);
        dispatch(new SendEmailJob($data, $mail_to, $url));
        $url = route('dispute_details', ['id' => $ticket->id]);
        dispatch(new SendEmailJob($data, $order->buyer?->email, $url));
    }

    public function render()
    {
        return view('livewire.admin.ticket.chat',[
            'chat' => Ticket::with([
                'ticketChat' => function($query){
                    $query->with(['sender' => function($query){
                        $query->select('id', 'name', 'profile_photo_path');
                    }]);
                },
                'seller' => function($query){
                    $query->select('id','name','profile_photo_path');
                },
                'buyer' => function($query){
                    $query->select('id','name','profile_photo_path');
                },
                'manager' => function($query){
                    $query->select('id','name','profile_photo_path');
                }
            ])
            ->where('id',$this->ticketId)
            ->first()
        ]);
    }
}
