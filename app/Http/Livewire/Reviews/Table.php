<?php

namespace App\Http\Livewire\Reviews;

use App\Models\User;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Pagination\Paginator;

class Table extends Component
{
  
  
    use WithPagination;
    public function mount() {
      
      
    }

    public function render()
    {
     
        return view('livewire.reviews.table',[
            'reviews' => Review::with('sentByUser')->where('to_user_id', Auth::user()->id)
            ->latest()
            ->paginate(5, ['*'], 'review-page')
        ]
           );
    }
}
