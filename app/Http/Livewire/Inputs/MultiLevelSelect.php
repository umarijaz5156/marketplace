<?php

namespace App\Http\Livewire\Inputs;

use Livewire\Component;

class MultiLevelSelect extends Component
{
    public $selectedCategory;
    public $categories;

    public function render()
    {
        return view('livewire.inputs.multi-level-select');
    }
    
    
    public function changeSelect($name)
    {
        $this->selectedCategory = $name;
      
    }
}
