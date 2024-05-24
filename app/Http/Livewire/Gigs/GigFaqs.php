<?php

namespace App\Http\Livewire\Gigs;

use Livewire\Component;

class GigFaqs extends Component
{

    public $gig;
    public $faqs;

    public function render()
    {
        return view('livewire.gigs.gig-faqs');
    }

    public function mount()
    {
        $this->faqs = $this->gig->gigFaqs;
    }
}
