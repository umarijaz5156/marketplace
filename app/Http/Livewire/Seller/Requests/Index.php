<?php

namespace App\Http\Livewire\Seller\Requests;

use App\Models\Category;
use App\Models\Request;
use Livewire\Component;

class Index extends Component
{
    public $categories = [];
    public $filterCategory = null;

    public function render()
    {
        $requests = Request::with('category')->
        when($this->filterCategory != null, function($query){
            $query->where('category_id', $this->filterCategory);
        })->
        where('status', 'active')->latest()->paginate(10);

        return view('livewire.seller.requests.index', [
            'requests' => $requests
        ])->layout('components.seller.dashboard-layout');
    }

    public function mount(){
        $this->categories = Category::with('childCategories')->where('parent_id', null)->get();
    }


}
