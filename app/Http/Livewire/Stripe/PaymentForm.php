<?php

namespace App\Http\Livewire\Stripe;

use Livewire\Component;

class PaymentForm extends Component
{
    public function render()
    {
        return view('livewire.stripe.payment-form');
    }
}
