<?php

namespace App\Http\Livewire\Dispute;

use App\Models\Ticket\Ticket;
use Livewire\Component;

class TicketsList extends Component
{

    public $tickets;
    public $selectedTicket;
    public $ticketId;
    

    protected $listeners = ['ticketSelected'];

    public function render()
    {
        return view('livewire.dispute.tickets-list');
    }

    public function mount()
    {
        $this->tickets = Ticket::where('buyer_id', auth()->user()->id)->latest()->get();
     
        if($this->ticketId){
            $this->getTicket();
        }
    }

     public function ticketSelected($ticket)
    {
        $this->selectedTicket = $ticket['id'];
        $this->emitTo('dispute.ticket-chat','loadChat',$ticket);
    }

    public function getTicket()
    {
        // $ticket = Ticket::find($this->ticketId);
        $this->selectedTicket = $this->ticketId;
    }
}
