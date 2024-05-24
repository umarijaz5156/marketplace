<?php

namespace App\Http\Livewire\Seller;

use Livewire\Component;

class StatsCard extends Component
{
    public $title;
    public $value;
    public $show;


    public function render()
    {
        return view('livewire.seller.stats-card');
    }
}
