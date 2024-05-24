<?php

namespace App\Http\Livewire;

use App\Models\Seller\GigDetail;
use Livewire\Component;

class SearchAutocomplete extends Component
{
    public $results;
    public $search;
    public $selected;
    public $showDropdown = false;

    public function mount()
    {
        $this->showDropdown = false;
        $this->results = collect();
    }

    public function updatedSelected()
    {
        $this->emitSelf('valueSelected', $this->selected);
    }

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = collect();
            $this->showDropdown = false;
            return;
        }

        if ($this->query()) {
            $this->results = $this->query()->get();
        } else {
            $this->results = collect();
        }

        $this->selected = '';
        $this->showDropdown = true;
    }

    public function query() {
        return GigDetail::where('title', 'like', '%'.$this->search.'%')->orderBy('title');
    }

    public function render()
    {
        return view('livewire.search-autocomplete');
    }
}