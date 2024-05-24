<?php

namespace App\Http\Livewire\HomePage;

use Livewire\Component;
use App\Models\Category;
use App\Events\UserStatus;
use App\Models\ConfigHome;
use App\Models\User;

class Categories extends Component
{
    public $data;
    public $limit=7;
    public $showMoreLink =false;
    public $totalCategories;

    public function mount() {
        
        // show online status of user
        if(auth()->check()){
            
            $user = User::find(auth()->user())->first();
            $user->is_online = true;
            $user->save();
            broadcast(new UserStatus($user));
        }
       
    }

    public function render()
    {
        $home = ConfigHome::first();

        if($home->status2 == 1) {
            $query = Category::whereIn('id', explode(',', $home->market_place_manual_categories));
        } else {
            $query = Category::with('detail');
            ;
        }

        
        $showMoreQuery = clone $query;
        $allCategoryQuery = clone $query;
        // $this->totalCategories = $this->calculateCount($allCategoryQuery->get());
        $this->data = $showMoreQuery->limit($this->limit)->latest()->get();
        $this->totalCategories = $allCategoryQuery->count();

        if($this->totalCategories > $this->limit){
            $this->showMoreLink = true;
        } else{
            $this->showMoreLink = false;
        }
        
        if(!isset($this->data) || count($this->data) == 0 || empty($this->data)) {
            $this->skipRender();
        }
        
        return view('livewire.home-page.categories', [
            'categories' => $this->data,
            'status' => ConfigHome::first()->status2
        ]);
    }

    public function loadMore()
    {
        $this->limit += 4;
        if($this->totalCategories >= $this->limit){
            $this->showMoreLink = true;
        } else{
            $this->showMoreLink = false;
        }
    }

    public function calculateCount($categories)
    {
        $count= 0;
        foreach($categories as $category)
        {
          
      
            $count++;
            if(isset($category->childCategories) && count($category->childCategories) > 0){
                $count += count($category->childCategories);
                if(isset($category->childCategories->childCategories) && count($category->childCategories->childCategories) > 0){
                    $count += count($category->childCategories->childCategories);
            
                }
            }
        }
      
        return $count;
    }
}
