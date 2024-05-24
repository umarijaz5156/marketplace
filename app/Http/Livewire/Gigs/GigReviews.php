<?php

namespace App\Http\Livewire\Gigs;

use App\Models\Review;
use App\Models\User;
use Livewire\Component;

class GigReviews extends Component
{
    public $gig;
    public $showMoreLink = true;
    public $limit = 5;
    public $reviewAverage;


    public function render()
    {
        $query = Review::where('gig_id', $this->gig->id)->where('to_user_id', $this->gig->seller->user_id);

        $queryCloneToGetLimitedRecord = clone $query;
        $queryGetAllReviews = clone $query;

        $reviews = $queryCloneToGetLimitedRecord->limit($this->limit)->latest()->get(); // get limited reviews

        $getAllReviews = $queryGetAllReviews->get(); // get all reviews
        // dd($getAllReviews);
        $totalReviews = $getAllReviews->count(); // total reviews count
        $fiveStars = $this->getRatingAverage(5, $getAllReviews);
        $fourStars = $this->getRatingAverage(4, $getAllReviews);
        $threeStars = $this->getRatingAverage(3, $getAllReviews);
        $twoStars = $this->getRatingAverage(2, $getAllReviews);
        $oneStar = $this->getRatingAverage(1, $getAllReviews);

        return view('livewire.gigs.gig-reviews', [
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'fiveStars' => $fiveStars,
            'fourStars' => $fourStars,
            'threeStars' => $threeStars,
            'twoStars' => $twoStars,
            'oneStar' => $oneStar
        ]);
    }

    public function mount($reviewAverage)
    {
        $this->reviewAverage = $reviewAverage;
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

    public function loadMoreReviews($totalReviews)
    {
        $this->limit = $this->limit + 4;
        if($this->limit >= $totalReviews)
            $this->showMoreLink = false;

    }

    public function loadLessReviews()
    {
        $this->limit = 2;
        $this->showMoreLink = true;
    }
}
