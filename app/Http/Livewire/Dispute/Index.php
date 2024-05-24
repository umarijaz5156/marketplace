<?php

namespace App\Http\Livewire\Dispute;

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
            $this->authorize('userView', $ticket);
        }

        return view('livewire.dispute.index');
    }

    public function mount($id = null)
    {
        $this->count = Ticket::where('buyer_id', auth()->user()->id)->count();
        $this->ticketId = $id;
    }
}
