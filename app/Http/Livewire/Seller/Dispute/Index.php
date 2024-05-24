<?php

namespace App\Http\Livewire\Seller\Dispute;

use Livewire\Component;
use App\Models\Ticket\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public $ticketId;
    public $count;

    public function render()
    {
        if($ticket = Ticket::find($this->ticketId)){
            $this->authorize('sellerView', $ticket);
        } 

        return view('livewire.seller.dispute.index')->layout('components.seller.dashboard-layout');
    }

    public function mount($id = null){
        $this->count = Ticket::where('seller_id', auth()->user()->id)->count();
        $this->ticketId  = $id;
    }
}
