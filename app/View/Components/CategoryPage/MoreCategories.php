<?php

namespace App\View\Components\CategoryPage;

use App\Models\Category;
use Illuminate\View\Component;

class MoreCategories extends Component
{
    public $categories = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Category::all(['id', 'name']);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-page.more-categories');
    }
}
