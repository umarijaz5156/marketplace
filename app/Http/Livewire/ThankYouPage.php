<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ThankYouPage extends Component
{
    public $orderId;

    public function render()
    {
        return view('livewire.thank-you-page');
    }

    public function mount($id)
    {
       
        $this->orderId = $id;
    }
}
