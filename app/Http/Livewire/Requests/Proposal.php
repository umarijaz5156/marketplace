<?php

namespace App\Http\Livewire\Requests;

use App\Models\ChatCenter\Chat;
use App\Models\ChatCenter\ChatMessage;
use App\Models\Proposal as ModelsProposal;
use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Proposal extends Component
{
    use AuthorizesRequests;

    public $sortField = 'id';
    public $sortAsc = false;
    public $request;
    public $detailsModal = false;
    public $proposalDetails;

    public function render()
    {
        $this->authorize('view', $this->request);
        $proposals = ModelsProposal::where('request_id', $this->request->id)->when($this->sortField, function ($query) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        })->paginate(10);
        return view('livewire.requests.proposal', compact('proposals'));
    }

    public function mount($id)
    {

        $this->request = Request::findOrFail($id);

    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
    public function openDetailsModal($id)
    {

        $this->detailsModal = true;
        $this->proposalDetails = ModelsProposal::findOrFail($id);
    }

    public function contact($proposalId)
    {
        $proposal = ModelsProposal::findOrFail($proposalId);
        $chat = Chat::where('sender_id', auth()->user()->id)
            ->where('receiver_id', $proposal->seller->user_id)
            ->where('content_type', 'Proposal')
            ->where('content_id', $proposalId)
            ->first();
        if ($chat) {

            return redirect(route('messages', ['id' => $chat->id]));
        } else {
            $createdChat = Chat::create([
                'sender_id' => auth()->user()->id,
                'receiver_id' => $proposal->seller->user_id,

                'content_type' => 'Proposal',
                'content_id' => $proposal->request->id,
                'last_reply_at' => Carbon::now()
            ]);
            return redirect(route('messages', ['id' => $createdChat->id]));
        }
    }
}
