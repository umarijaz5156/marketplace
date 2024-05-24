<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Review;
use App\Models\Country;
use Livewire\Component;
use App\Models\Seller\Seller;
use App\Models\Seller\SellerProfile;
use App\Models\Seller\SellerStat;

class SellerProfilePage extends Component
{
    public $gig;
    public $seller;
    public $sellerDetails;
    public $sellerStats;
    public $country;
    public $user;
    public $isOwner;
    public $limit = 5;

    public $reviewsAverage;


    public function checkIsOwner()
    {

        if(auth()->check()){
            $seller = Seller::where('id', $this->seller->id)->first(['id', 'user_id']);
            if($seller){

                if($seller->user_id == auth()->user()->id){

                    $this->isOwner = true;
                } else{
                    $this->isOwner = false;
                }
            } else{
                $this->isOwner = false;
            }
        }

    }



    public function render()
    {

        $this->sellerDetails = SellerProfile::where('seller_id', $this->seller->id)->first();
        $this->sellerStats = SellerStat::where('seller_id', $this->seller->id)->first();
        $this->country = Country::where('id',$this->sellerDetails->country_id)->first();
        $this->user = User::where('id',$this->seller->user_id)->first(['profile_photo_path', 'name']);
        $this->reviewsAverage = $this->sellerStats->reviews_average;
        if(isset($this->gig)){
            $query = Review::where('to_user_id', $this->gig->seller->user_id);
        } else{
            $query = Review::where('to_user_id', $this->seller->user_id);
        }


        $queryCloneToGetLimitedRecord = clone $query;
        $queryGetAllReviews = clone $query;

        $reviews = $queryCloneToGetLimitedRecord->limit($this->limit)->latest()->get(); // get limited reviews

        $getAllReviews = $queryGetAllReviews->get(); // get all reviews

        $totalReviews = $getAllReviews->count(); // total reviews count
        $fiveStars = $this->getRatingAverage(5, $getAllReviews);
        $fourStars = $this->getRatingAverage(4, $getAllReviews);
        $threeStars = $this->getRatingAverage(3, $getAllReviews);
        $twoStars = $this->getRatingAverage(2, $getAllReviews);
        $oneStar = $this->getRatingAverage(1, $getAllReviews);

        $this->checkIsOwner();

        return view('livewire.seller-profile-page', [
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

}
