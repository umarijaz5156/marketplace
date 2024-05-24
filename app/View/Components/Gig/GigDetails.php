<?php

namespace App\View\Components\Gig;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\Models\Seller\SellerStat;
use App\Models\User;
use Illuminate\View\Component;

class GigDetails extends Component
{

    public $gig;
    public $reviewAverage;
    public $totalReviews;
    public $seller;
    public $breadcrumbs;
    public $count;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($gig)
    {
        $this->gig = $gig;
        $stats = SellerStat::where('seller_id', $this->gig->seller_id)->first(['seller_id', 'total_reviews', 'reviews_average']);
        $this->reviewAverage = $stats->reviews_average;
        $this->totalReviews = $stats->total_reviews;
        $this->seller = User::where('id', $this->gig->seller_id)->first(['profile_photo_path', 'name']);
        $this->breadcrumbs = $this->gig->categories()->distinct()->get()->sortBy('pivot.level');
        $this->count = $this->getQueuedOrders();
        // $this->profileImage = $seller->profile_photo_path;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.gig.gig-details');
    }

     public function getQueuedOrders()
    {
        return  Order::where('seller_id', $this->gig->seller_id)
                        ->where('status', OrderStatus::InProgress->value)
                        ->orWhere('status', OrderStatus::Pending->value)
                        ->orWhere('status', OrderStatus::Disputed->value)
                        ->count();

    }
}
