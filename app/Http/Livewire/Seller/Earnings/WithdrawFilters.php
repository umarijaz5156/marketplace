<?php

namespace App\Http\Livewire\Seller\Earnings;

use App\Models\Seller\Seller;
use Livewire\Component;

class WithdrawFilters extends Component
{
    public $option;
    public $email;

    protected $rules = [
        'option' => 'required',
        'email' => 'required|email'
    ];

    public function render()
    {
     
       
       return view('livewire.seller.earnings.withdraw-filters');
    }

    public function mount(){
        $seller = Seller::where('user_id', auth()->user()->id)->first(['withdraw_type', 'withdraw_email']);
        $this->option = $seller->withdraw_type;
        $this->email = $seller->withdraw_email; 
    }

    public function save()
    {
        $this->validate();
        $seller = Seller::where('user_id', auth()->user()->id)->update([
            'withdraw_type' => $this->option,
            'withdraw_email' => $this->email
        ]);
        session()->flash('message', 'Saved');
   
    }
}
