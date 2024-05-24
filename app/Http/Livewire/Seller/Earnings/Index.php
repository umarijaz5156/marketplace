<?php

namespace App\Http\Livewire\Seller\Earnings;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.seller.earnings.index')->layout('components.seller.dashboard-layout');
    }
}
