<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;

class RecentOders extends Component
{
    public function render()
    {
        return view('livewire.seller.recent-oders')->layout('components.seller.dashboard-layout');
    }
}
