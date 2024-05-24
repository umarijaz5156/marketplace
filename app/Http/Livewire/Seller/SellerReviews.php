<?php

namespace App\Http\Livewire\Seller;

use App\Models\Review;
use App\Models\User;
use Livewire\Component;

class SellerReviews extends Component
{

    public $seller;
    public $showMoreLink = true;
    public $limit = 4;

    public function render()
    {
        $query = Review::where('to_user_id',$this->seller->user_id)->where('review_type', 'buyer');

        $queryCloneForLimitedReviews = clone $query;
        $queryCloneForGetAllReviews = clone $query;

        $reviews = $queryCloneForLimitedReviews->take($this->limit)->latest()->get(); // get limited reviews
        $getAllReviews = $queryCloneForGetAllReviews->get(); // get all reviews

        $totalReviews = $getAllReviews->count(); // get total reviews count

        $fiveStars = $this->getRatingAverage(5, $getAllReviews);
        $fourStars = $this->getRatingAverage(4, $getAllReviews);
        $threeStars = $this->getRatingAverage(3, $getAllReviews);
        $twoStars = $this->getRatingAverage(2, $getAllReviews);
        $oneStar = $this->getRatingAverage(1, $getAllReviews);

        return view('livewire.seller.seller-reviews', [
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'fiveStars' => $fiveStars,
            'fourStars' => $fourStars,
            'threeStars' => $threeStars,
            'twoStars' => $twoStars,
            'oneStar' => $oneStar
        ]);
    }
    
    public function getRatingAverage($rating, $reviews)
    {
        $totalReviews = $reviews->count();
        $reviewsCountByRating = $reviews->where('rating', $rating)->count();
        $average = $totalReviews > 0 ? ($reviewsCountByRating/$totalReviews) * 100 : 0;
        
        return ['average' => $average, 'count' => $reviewsCountByRating];
    }

    public function getUserName($id)
    {   
        
        $user  = User::where('id', $id)->first();
        return $user->name;
    }

    public function getProfilePath($id){
        $user = User::where('id', $id)->first()->profile_photo_path;
        return $user;
        // return $user->profile_photo_path;
    }

    public function loadMoreReviews($totalReviews)
    {
        $this->limit = $this->limit + 8;
        if($this->limit >= $totalReviews)
            $this->showMoreLink = false;

    }

    public function loadLessReviews()
    {
        $this->limit = 4;
        $this->showMoreLink = true;
    }
}
