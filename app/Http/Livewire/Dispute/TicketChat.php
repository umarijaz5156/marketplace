<?php

namespace App\Http\Livewire\Dispute;

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

        $this->dispatchBrowserEvent('scrollToBottom', ['id' => 'chatBox']);
        $data = ['body' => 'New Reply Recieved on Ticket #'.$ticket->id. ' By '. $ticket->buyer?->name, 'subject' => 'New Reply Recieved on Ticket'];
        $order = $ticket->order;
        $mail_to = $order->seller?->user->email;
        $url = route('seller.dispute-details', ['id' => $ticket->id]);
        dispatch(new SendEmailJob($data, $mail_to, $url));
        $url = route('admin.ticket_chat', ['ticketId' => $ticket->id]);
        dispatch(new SendEmailJob($data, $ticket->manager->email, $url));
    }

    public function render()
    {
        return view('livewire.dispute.ticket-chat');
    }

    public function mount()
    {
        if($this->ticketId) {
            $ticket = Ticket::find($this->ticketId);
            if($ticket){
                $this->loadChat($ticket);
            }

        }
    }

    public function loadChat($ticket)
    {
        $this->orderId = $ticket['order_id'];
        $this->ticketId = $ticket['id'];
        $this->senderId = auth()->user()->id;
        $this->chat = Ticket::with(['ticketChat'])
            ->where('id',$this->ticketId)
            ->first();

        $this->dispatchBrowserEvent('scrollToBottom', ['id' => 'ChatArea']);
    }


}
