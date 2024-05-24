<?php

namespace App\Http\Livewire\Seller\Earnings;

use App\Models\Seller\Seller;
use App\Models\Seller\SellerPayout;
use Illuminate\Cache\RateLimiting\Limit;
use Livewire\Component;
use Illuminate\Support\Facades\App;
use Stripe\StripeClient;

class WithdrawsTable extends Component
{
    public $limit = 5;
    public $payouts;
    protected StripeClient $stripeClient;

    public function render()
    {

        $this->stripeClient = App::make(StripeClient::class);
        $this->payouts = $this->stripeClient->payouts->all($this->limit ? ['limit' => $this->limit] : [], [ 'stripe_account' =>  auth()->user()->seller->stripe_connect_id,])->data;
        return view('livewire.seller.earnings.withdraws-table');
    }

    public function getPayouts()
    {
        $seller = Seller::where('user_id', auth()->user()->id)->first()->id;
        $this->payouts = SellerPayout::where('status', 2)->where('seller_id', $seller)->limit($this->limit)->get();

    }

    protected static function stripeFormat($amount)
	{
		$amount = $amount / 100;
		return round($amount,2);
	}

    public function mount()
    {
        // $this->getPayouts();
    }
}
