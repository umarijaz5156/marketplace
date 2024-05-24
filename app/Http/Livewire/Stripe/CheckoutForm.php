<?php

namespace App\Http\Livewire\Stripe;

use Livewire\Component;
use App\Models\Order\Order;

class CheckoutForm extends Component
{
    public $order;

    public function mount(Order $order)
    {
       $this->order = $order;
    }

    public function render()
    {
        return view('livewire.stripe.checkout-form');
    }
}
