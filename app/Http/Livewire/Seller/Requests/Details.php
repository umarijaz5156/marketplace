<?php

namespace App\Http\Livewire\Seller\Requests;

use App\Jobs\SendEmailJob;
use App\Models\Proposal;
use App\Models\Request;
use Livewire\Component;

class Details extends Component
{
    public $request;

    public $proposal, $price, $duration;
    public $isEdit = false;
    public function render()
    {
        return view('livewire.seller.requests.details')->layout('components.seller.dashboard-layout');
    }

    public function mount($id)
    {
        $this->request = Request::find($id);
        $proposal = $this->request->proposals?->where('seller_id', auth()->user()->seller->id)->first();
        if($proposal){
            $this->isEdit = true;
            $this->proposal = $proposal->proposal;
            $this->price = $proposal->price;
            $this->duration = $proposal->duration;
        }

    }

    public function submit(){
        $this->validate([
            'proposal' => 'required|max:2000',
            'price' => 'required|min:0|max:5000',
            'duration' => 'required|min:1|max:999'
        ]);

        $proposal  = new Proposal();
        $proposal->proposal = $this->proposal;
        $proposal->price = $this->price;
        $proposal->duration = $this->duration;
        $proposal->request_id = $this->request->id;
        $proposal->seller_id = auth()->user()->seller->id;
         $proposal->save();

         $data['subject'] = 'Bid Placed On a Job';
         $data['body'] = 'Your job got a new bid';
         $mail_to = $this->request->user;
         $url = route('request.proposals', $this->request->id);
         dispatch(new SendEmailJob($data, $mail_to , $url));
        session()->flash('success','Proposal Sent Successfully');
        return redirect()->route('seller.requests')->with('success', 'Proposal Sent Successfully');
    }
}
