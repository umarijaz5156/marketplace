<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Stripe\StripeClient;
use App\Enums\OrderStatus;
use App\Enums\PayoutStatus;
use App\Models\Order\Order;
use App\Models\Seller\SellerPayout;
use Illuminate\Support\Facades\App;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;

    public $availableBalance = 0;
    public $pendingBalance = 0;
    private StripeClient $stripeClient;
    public $changeStatusId;
    public $openModal = false;
    public $selectedStatus;

    protected $rules = [
        'selectedStatus' => 'required'
    ];

    public function render()
    {   
      
        $payouts =  $this->getOrderDetails();
        
        return view('livewire.admin.transactions',['payouts' => $payouts])->layout('components.admin-layout');;
    }

    

    public function getOrderDetails()
    {
        $payouts = SellerPayout::join('sellers', 'sellers.id', '=' , 'seller_payouts.seller_id')
        ->join('orders', function($join){
            $join->on('orders.id', '=', 'seller_payouts.order_id')
            ->where('orders.status' , '=', OrderStatus::Completed->value);
        })
       
        ->select('seller_payouts.id as payout_id','seller_payouts.order_id', 'seller_payouts.seller_id as seller_id', 'seller_payouts.amount as amount', 'seller_payouts.status as payout_status'
        ,'sellers.withdraw_type as withdraw_type', 'sellers.withdraw_email as email', 'sellers.id', 'seller_payouts.created_at')
        ->latest()
        ->paginate(10);
       
       return $payouts;
     
    }

    public function mount()
    {
        $this->stripeClient =  App::make(StripeClient::class);
        $balance = $this->stripeClient->balance->retrieve();
        foreach($balance->available as $blnc){
            $this->availableBalance += ($blnc->amount / 100); 
        }

        foreach($balance->pending as $blnc){
            $this->pendingBalance += ($blnc->amount / 100);
        }
    }

    public function changeStatus($id , $status){
      
        $this->changeStatusId = $id;
        $this->selectedStatus = $status;
        $this->openModal = true;
    }

    public function saveStatus(){

        
        $this->validateOnly('selectedStatus');
        
        SellerPayout::find($this->changeStatusId)->update([
            'status' => $this->selectedStatus
        ]);
       
        session()->flash('message', 'Status Updated Successfully');
    }
}
