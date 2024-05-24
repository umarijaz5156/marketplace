<?php

namespace App\Http\Livewire\Seller\Dispute;

use App\Jobs\SendEmailJob;
use Livewire\Component;
use App\Models\Ticket\Ticket;
use App\Models\TicketChat as ModelsTicketChat;

class TicketChat extends Component
{



    public $ticketId;
    public $senderId;
    public $message;
    public $chat;
    public $orderId;

    protected $listeners = ['loadChat', 'emitRefresh' => '$refresh'];


     public function render()
    {
        return view('livewire.seller.dispute.ticket-chat');
    }
     public function mount()
    {
        if($this->ticketId) {
            $ticket = Ticket::find($this->ticketId);
            $this->loadChat($ticket);
        }
    }



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

        ModelsTicketChat::create($data);
        $this->message = '';
        $this->loadChat($ticket);

        $this->dispatchBrowserEvent('ticketSelected', ['id' => 'ChatArea']);
        $data = ['body' => 'New Reply Recieved on Ticket #'.$ticket->id. ' By '. $ticket->seller?->name, 'subject' => 'New Reply Recieved on Ticket'];
        $order = $ticket->order;
        $mail_to = $order->buyer?->email;
        $url = route('dispute_details', ['id' => $ticket->id]);
        dispatch(new SendEmailJob($data, $mail_to, $url));

        $url = route('manager.messages', ['id' => $ticket->id]);
        dispatch(new SendEmailJob($data, $ticket->manager->email, $url));

    }



    public function loadChat($ticket)
    {
        if($ticket){
            $this->ticketId = $ticket['id'];
            $this->orderId = $ticket['order_id'];
            $this->senderId = auth()->user()->id;
            $this->chat = Ticket::with(['ticketChat'])
            ->where('id',$this->ticketId)
            ->first();

            $this->dispatchBrowserEvent('ticketSelected', ['id' => 'chatBox']);
        }

    }

}
