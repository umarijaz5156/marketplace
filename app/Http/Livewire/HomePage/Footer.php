<?php

namespace App\Http\Livewire\HomePage;

use App\Models\Category;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.home-page.footer', [
            'categories' => Category::select('id','name')->whereNull('parent_id')->get()
        ]);
    }
}
