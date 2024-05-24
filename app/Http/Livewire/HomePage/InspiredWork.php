<?php

namespace App\Http\Livewire\HomePage;

use Livewire\Component;

class InspiredWork extends Component
{
    public $freelancers;

    public function render()
    {
        if(!isset($this->freelancers) || count($this->freelancers) == 0 || empty($this->freelancers)) {
            $this->skipRender();
        }

        return view('livewire.home-page.inspired-work');
    }
}
