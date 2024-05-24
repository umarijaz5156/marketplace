<?php

namespace App\Http\Livewire\Gigs;

use App\Models\User;
use App\Models\Review;
use Livewire\Component;

class SellerReviews extends Component
{

    public $showMoreLink = 1;
    public $limit = 5;
    public $reviewsAverage;
    public $gig;
    public $totalReviews;
    public $seller;

    public function render()
    {
        if(isset($this->gig)){
            $query = Review::where('to_user_id', $this->gig->seller->user_id);
        } else{
            $query = Review::where('to_user_id', $this->seller->user_id);
        }


        $queryCloneToGetLimitedRecord = clone $query;
        $queryGetAllReviews = clone $query;

        $reviews = $queryCloneToGetLimitedRecord->limit($this->limit)->latest()->get(); // get limited reviews

        $getAllReviews = $queryGetAllReviews->get(); // get all reviews
        $this->totalReviews = $getAllReviews->count();
        return view('livewire.gigs.seller-reviews', [
            'reviews' => $reviews,
        ]);
    }



    public function loadMoreReviews($totalReviews)
    {
        $this->limit = $this->limit + 4;
        if($this->limit >= $totalReviews){
            $this->showMoreLink = 0;
        }else{
            $this->showMoreLink = 1;
        }

    }

    public function loadLessReviews()
    {
        $this->limit = 2;
        $this->showMoreLink = 1;
    }

    public function getProp($id, $prop)
    {
        $user  = User::where('id', $id)->first();
        return $user->$prop;
    }
}
