<?php

namespace App\Http\Livewire\Requests;

use App\Models\Offer;
use App\Models\Proposal;
use App\Models\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class RequestDetails extends Component
{

    public $request_id;
    public function render()
    {
        $req = Request::findOrFail($this->request_id);
        return view('livewire.requests.reqeust-details', ['request' => $req]);

    }

    public function mount($id){
        $this->request_id = $id;
    }

    public function bid(){
        if(auth()->check()){
            if(auth()->user()->is_seller){
                return redirect(route('seller.requests.details', $this->request_id));
            } else{
                session(['url.intended' => route('seller.requests.details', $this->request_id)]);
                return redirect(route('seller-register'));
            }
        } else{
            session(['url.intended' => route('requests.details', $this->request_id)]);
            return redirect(route('login'));
        }

    }

    public function canBid()
    {
        $reqeust = Request::find($this->request_id);
        if($reqeust->user_id == auth()->user()->id){
            return false;
        }
        if($reqeust && $reqeust->status == 'inactive'){
            return false;
        }
        if(Auth::check()){
            $proposal = Proposal::where('request_id', $this->request_id)->where('seller_id', auth()->user()->seller?->id)->count();

            return $proposal == 0 ? true : false;
        } else{
            return true;
        }

    }
}
