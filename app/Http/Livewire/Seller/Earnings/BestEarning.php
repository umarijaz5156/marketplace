<?php

namespace App\Http\Livewire\Seller\Earnings;

use Livewire\Component;
use Stripe\StripeClient;
use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\Models\Seller\Seller;
use App\Models\Seller\SellerPayout;
use Illuminate\Support\Facades\App;

class BestEarning extends Component
{
    public $sellerStats;
    public $seller;
    public $expectedIncome;
    public $availableWithdraw = 0;
    public $pendingClearence = 0;
    public $cancelledIncome;
    public $netIncome;
    public $openModal =false;
    public $COMMISSION;
    public $payouts;
    public $withdrawn = 0;
    private StripeClient $stripeClient;





    public function render()
    {
        // $this->sellerStats = $seller->sellerStat;
        $query = Seller::
            join('orders', 'orders.seller_id', '=', 'sellers.id')
            ->join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
            ->where('sellers.user_id', auth()->user()->id)
            ->selectRaw('SUM(o_d.total) as total')
            ->groupBy('orders.seller_id');

        $queryForExpectedIncome = clone $query;
        $queryForCancelledIncome = clone $query;
        $queryForTotalIncome = clone $query;

        $this->netIncome = $queryForTotalIncome->
            where('orders.status', OrderStatus::Completed->value)

            ->first();

        $this->expectedIncome = $queryForExpectedIncome
                ->where(function($query) {
                    $query->where('orders.status', OrderStatus::Delivered->value)
                    ->orWhere('orders.status', OrderStatus::Disputed->value)
                    ->orWhere('orders.status', OrderStatus::InProgress->value)
                    ->orWhere('orders.status', OrderStatus::Pending->value);
                })
                ->first();


        $this->cancelledIncome = $queryForCancelledIncome->
            where('orders.status', OrderStatus::Cancelled->value)
            ->first();

        return view('livewire.seller.earnings.best-earning');
    }

    public function mount()
    {
        $this->seller = Seller::with(['sellerStat'])
        ->where('user_id', auth()->user()->id)->first();

        // $payouts = SellerPayout::join('orders', function($join){
        //     $join->on('seller_payouts.order_id', '=' ,'orders.id')
        //     ->where('orders.status', '=', OrderStatus::Completed->value);
        // })->where('seller_payouts.status', '=', 1)->where('seller_payouts.seller_id', $this->seller->id)->selectRaw('SUM(seller_payouts.amount) as total')->first();

        // $this->availableWithdraw= $payouts?->total;
        // $this->withdrawn = SellerPayout::where('seller_id', $this->seller->id)->where('status',2)->sum('amount');

       $this->stripeClient = App::make(StripeClient::class);

       if($this->seller->stripe_onboarded && $this->seller->stripe_connect_id){
        $balance = $this->stripeClient->balance->retrieve(
            array(),
            array(
                'stripe_account' =>  $this->seller->stripe_connect_id,

            )
        );
        foreach($balance->pending as $pendingBalance){
            $this->pendingClearence += (self::stripeFormat($pendingBalance->amount));
       }

       foreach($balance->available as $availableBalance){
        $this->availableWithdraw += (self::stripeFormat($availableBalance->amount));
       }
        $this->payouts = $this->stripeClient->payouts->all([], [ 'stripe_account' =>  auth()->user()->seller->stripe_connect_id,])->data;
        foreach($this->payouts as $payout){
            if($payout->status == 'paid')
            {
                $this->withdrawn += self::stripeFormat($payout->amount);
            }

        }
       }

    }

    public function toggleModal()
    {
        $this->openModal = !$this->openModal;
    }

     protected static function stripeFormat($amount)
	{
		$amount = $amount / 100;
		return round($amount,2);
	}


}
