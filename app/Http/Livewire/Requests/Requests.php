<?php

namespace App\Http\Livewire\Requests;

use App\Models\Category;
use App\Models\Request;
use Livewire\Component;

class Requests extends Component
{
    public $sortField = 'id';
    public $sortAsc = false;
    public $categories = [];
    public $filterCategory = null;
    public function render()
    {
        $requests = Request::with('category')->
        when($this->filterCategory != null, function($query){
            $query->where('category_id', $this->filterCategory);
        })->when($this->sortField, function($query) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        })->where('status', 'active')->paginate(10);

        return view('livewire.requests.requests', compact('requests'));
    }

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function mount(){
        $this->categories = Category::with('childCategories')->where('parent_id', null)->get();
    }
}
