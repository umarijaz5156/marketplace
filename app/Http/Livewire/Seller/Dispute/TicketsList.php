<?php

namespace App\Http\Livewire\Seller\Dispute;

use App\Models\Seller\Seller;
use Livewire\Component;
use App\Models\Ticket\Ticket;

class TicketsList extends Component
{

    public $tickets;
    public $ticketId;
    public $selectedTicket;

    protected $listeners = ['ticketSelected'];

    
    public function render()
    {
      
        return view('livewire.seller.dispute.tickets-list');
    }
 
    public function mount()
    {
        
        $this->tickets = Ticket::where('seller_id', auth()->user()->id)->latest()->get();
        if($this->ticketId){
            $this->getTicket();
        }
    }

     public function ticketSelected($ticket)
    {
        $this->selectedTicket = $ticket['id'];
        $this->emitTo('seller.dispute.ticket-chat','loadChat',$ticket);
    }


    public function getTicket()
    {
        $this->selectedTicket = $this->ticketId;
    }
}
