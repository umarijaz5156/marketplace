<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting\AlsoViewed;
use App\Models\Setting\GigViewPageRcmndedGig;
use App\Models\Setting\OurFreelancersForGigView;
use App\Models\Setting\OurFreelancersForHome;
use App\Models\Setting\PopularServicesHome;
use Carbon\Carbon;
use Livewire\Component;

class ManageContentSettings extends Component
{
    public $optionValues = [1,2,3,4,5];
    public $sellerRatingForGigView;
    public $gigRatingForGigView;
    public $gigOrdersForGigView;
    public $sellerOrdersForGigView;
    public $sellerRegDateForGigView;
    public $gigAddDateForGigView;
    public $limit;

    public $sellerRatingForAlsoViewOnGigView;
    public $gigRatingForAlsoViewOnGigView;
    public $gigOrdersForAlsoViewOnGigView;
    public $sellerOrdersForAlsoViewOnGigView;
    public $sellerRegDateForAlsoViewOnGigView;
    public $gigAddDateForAlsoViewOnGigView;
    public $limitForAlsoViewOnGigView;

    public $sellerRatingForOurFreelancersOnGigView;
    public $sellerOrdersForOurFreelancersOnGigView;
    public $sellerRegDateForOurFreelancersOnGigView;
    public $limitForOurFreelancersOnGigView;

    public $sellerRatingForOurFreelancersOnHome;
    public $sellerOrdersForOurFreelancersOnHome;
    public $sellerRegDateForOurFreelancersOnHome;
    public $limitForOurFreelancersOnHome;

    public $sellerRatingForPopularServicesHome;
    public $gigRatingForPopularServicesHome;
    public $gigOrdersForPopularServicesHome;
    public $sellerOrdersForPopularServicesHome;
    public $sellerRegDateForPopularServicesHome;
    public $gigAddDateForPopularServicesHome;
    public $limitForPopularServicesHome;

    public $rcmndGigStatus;
    public $whoViewdServiceStatus;
    public $ourFreelancersGWPStatus;
    public $ourFreelancersHomePageStatus;
    public $popularProServicesHomePageStatus; 

    protected function rules()
    {
        return [
            'sellerRatingForGigView' => 'required|integer|between:1,5',
            'gigRatingForGigView' => 'required|integer|between:1,5',
            'gigOrdersForGigView' => 'required|integer|between:1,5',
            'sellerOrdersForGigView' => 'required',
            'sellerRegDateForGigView' => 'required',
            'gigAddDateForGigView' => 'required',
            'limit' =>  'required|numeric|min:4',

            'sellerRatingForAlsoViewOnGigView' => 'required|integer|between:1,5',
            'gigRatingForAlsoViewOnGigView' => 'required|integer|between:1,5',
            'gigOrdersForAlsoViewOnGigView' => 'required|integer|between:1,5',
            'sellerOrdersForAlsoViewOnGigView' => 'required',
            'sellerRegDateForAlsoViewOnGigView' => 'required',
            'gigAddDateForAlsoViewOnGigView' => 'required',
            'limitForAlsoViewOnGigView' => 'required|numeric|min:4',

            'sellerRatingForOurFreelancersOnGigView' => 'required|integer|between:1,5',
            'sellerOrdersForOurFreelancersOnGigView' => 'required',
            'sellerRegDateForOurFreelancersOnGigView' => 'required',
            'limitForOurFreelancersOnGigView' => 'required|numeric|min:4',

            'sellerRatingForOurFreelancersOnHome' => 'required|integer|between:1,5',
            'sellerOrdersForOurFreelancersOnHome' => 'required',
            'sellerRegDateForOurFreelancersOnHome' => 'required',
            'limitForOurFreelancersOnHome' => 'required|numeric|min:4',

            'sellerRatingForPopularServicesHome' => 'required',
            'gigRatingForPopularServicesHome' => 'required',
            'gigOrdersForPopularServicesHome' => 'required',
            'sellerOrdersForPopularServicesHome' => 'required',
            'sellerRegDateForPopularServicesHome' => 'required',
            'gigAddDateForPopularServicesHome' => 'required',
            'limitForPopularServicesHome' => 'required|numeric|min:4'
        ];
    }

    public function mount()
    {
        // recommended gigs for gig view
        $this->sellerRatingForGigView = GigViewPageRcmndedGig::first()->seller_rating;
        $this->gigRatingForGigView = GigViewPageRcmndedGig::first()->gig_rating;
        $this->gigOrdersForGigView = GigViewPageRcmndedGig::first()->gig_orders;
        $this->sellerOrdersForGigView = GigViewPageRcmndedGig::first()->seller_orders;
        $this->sellerRegDateForGigView = Carbon::parse(GigViewPageRcmndedGig::first()->seller_reg_date)->format('Y-m-d');
        $this->gigAddDateForGigView = Carbon::parse(GigViewPageRcmndedGig::first()->gig_add_date)->format('Y-m-d');
        $this->limit = GigViewPageRcmndedGig::first()->gigs_limit;
        $this->rcmndGigStatus = GigViewPageRcmndedGig::first()->status;

        // also viewed for gig view
        $this->sellerRatingForAlsoViewOnGigView = AlsoViewed::first()->seller_rating;
        $this->gigRatingForAlsoViewOnGigView = AlsoViewed::first()->gig_rating;
        $this->gigOrdersForAlsoViewOnGigView = AlsoViewed::first()->gig_orders;
        $this->sellerOrdersForAlsoViewOnGigView = AlsoViewed::first()->seller_orders;
        $this->sellerRegDateForAlsoViewOnGigView = Carbon::parse(AlsoViewed::first()->seller_reg_date)->format('Y-m-d');
        $this->gigAddDateForAlsoViewOnGigView = Carbon::parse(AlsoViewed::first()->gig_add_date)->format('Y-m-d');
        $this->limitForAlsoViewOnGigView = AlsoViewed::first()->gigs_limit;
        $this->whoViewdServiceStatus = AlsoViewed::first()->status;

        // our freelancers for gig view
        $this->sellerRatingForOurFreelancersOnGigView = OurFreelancersForGigView::first()->seller_rating;
        $this->sellerOrdersForOurFreelancersOnGigView = OurFreelancersForGigView::first()->seller_orders;
        $this->sellerRegDateForOurFreelancersOnGigView = Carbon::parse(OurFreelancersForGigView::first()->seller_reg_date)->format('Y-m-d');
        $this->limitForOurFreelancersOnGigView = OurFreelancersForGigView::first()->limit;
        $this->ourFreelancersGWPStatus = OurFreelancersForGigView::first()->status;

        // our free lancers for homepage
        $this->sellerRatingForOurFreelancersOnHome = OurFreelancersForHome::first()->seller_rating;
        $this->sellerOrdersForOurFreelancersOnHome = OurFreelancersForHome::first()->seller_orders;
        $this->sellerRegDateForOurFreelancersOnHome = Carbon::parse(OurFreelancersForHome::first()->seller_reg_date)->format('Y-m-d');
        $this->limitForOurFreelancersOnHome = OurFreelancersForHome::first()->limit;
        $this->ourFreelancersHomePageStatus = OurFreelancersForHome::first()->status;

        // also viewed for gig view
        $this->sellerRatingForPopularServicesHome = PopularServicesHome::first()->seller_rating;
        $this->gigRatingForPopularServicesHome = PopularServicesHome::first()->gig_rating;
        $this->gigOrdersForPopularServicesHome = PopularServicesHome::first()->gig_orders;
        $this->sellerOrdersForPopularServicesHome = PopularServicesHome::first()->seller_orders;
        $this->sellerRegDateForPopularServicesHome = Carbon::parse(PopularServicesHome::first()->seller_reg_date)->format('Y-m-d');
        $this->gigAddDateForPopularServicesHome = Carbon::parse(PopularServicesHome::first()->gig_add_date)->format('Y-m-d');
        $this->limitForPopularServicesHome = PopularServicesHome::first()->limit;
        $this->popularProServicesHomePageStatus = PopularServicesHome::first()->status;
    }

    public function updatedRcmndGigStatus($value)
    {
        GigViewPageRcmndedGig::where('id',1)->update(['status' => $value ? 1 : 0]);
    }

    public function updatedWhoViewdServiceStatus($value)
    {
        AlsoViewed::where('id',1)->update(['status' => $value ? 1 : 0]);
    }

    public function updatedOurFreelancersGWPStatus($value)
    {
        OurFreelancersForGigView::where('id',1)->update(['status' => $value ? 1 : 0]);
    }

    public function updatedOurFreelancersHomePageStatus($value)
    {
        OurFreelancersForHome::where('id',1)->update(['status' => $value ? 1 : 0]);
    }

    public function updatedPopularProServicesHomePageStatus($value)
    {
        PopularServicesHome::where('id',1)->update(['status' => $value ? 1 : 0]);
    }

    public function updateContentSettings()
    {
        $this->validate();

        // Recommended gigs for gig view page update
        $recommendedGigViewPageData = [
            'seller_rating' => $this->sellerRatingForGigView,
            'gig_rating' => $this->gigRatingForGigView,
            'gig_orders' => $this->gigOrdersForGigView,
            'seller_orders' => $this->sellerOrdersForGigView,
            'seller_reg_date' => $this->sellerRegDateForGigView,
            'gig_add_date' => $this->gigAddDateForGigView,
            'gigs_limit' => $this->limit
        ];

        GigViewPageRcmndedGig::where('id',1)->update($recommendedGigViewPageData);

        // Also Viewed Gigs for gig view page Update
        $alsoViewedData = [
            'seller_rating' => $this->sellerRatingForAlsoViewOnGigView ,
            'gig_rating' => $this->gigRatingForAlsoViewOnGigView ,
            'gig_orders' => $this->gigOrdersForAlsoViewOnGigView ,
            'seller_orders' => $this->sellerOrdersForAlsoViewOnGigView ,
            'seller_reg_date' => $this->sellerRegDateForAlsoViewOnGigView ,
            'gig_add_date' => $this->gigAddDateForAlsoViewOnGigView ,
            'gigs_limit' => $this->limitForAlsoViewOnGigView 
        ];

        AlsoViewed::where('id',1)->update($alsoViewedData);

        // Our freelancers for gig view page update
        $ourFreelancersData = [
            'seller_rating' => $this->sellerRatingForOurFreelancersOnGigView,
            'seller_orders' => $this->sellerOrdersForOurFreelancersOnGigView,
            'seller_reg_date' => $this->sellerRegDateForOurFreelancersOnGigView,
            'limit' => $this->limitForOurFreelancersOnGigView
        ];

        OurFreelancersForGigView::where('id', 1)->update($ourFreelancersData);

        // Our freelancers for home page update
        $ourFreelancersDataForHome = [
            'seller_rating' => $this->sellerRatingForOurFreelancersOnHome,
            'seller_orders' => $this->sellerOrdersForOurFreelancersOnHome,
            'seller_reg_date' => $this->sellerRegDateForOurFreelancersOnHome,
            'limit' => $this->limitForOurFreelancersOnHome
        ];

        OurFreelancersForHome::where('id', 1)->update($ourFreelancersDataForHome);

        // Also Viewed Gigs for gig view page Update
        $popularServicesHome = [
            'seller_rating' => $this->sellerRatingForPopularServicesHome ,
            'gig_rating' => $this->gigRatingForPopularServicesHome ,
            'gig_orders' => $this->gigOrdersForPopularServicesHome ,
            'seller_orders' => $this->sellerOrdersForPopularServicesHome ,
            'seller_reg_date' => $this->sellerRegDateForPopularServicesHome ,
            'gig_add_date' => $this->gigAddDateForPopularServicesHome ,
            'limit' => $this->limitForPopularServicesHome 
        ];

        PopularServicesHome::where('id',1)->update($popularServicesHome);

        // Redirect
        redirect()->route('admin.configs')->with('success', 'Record updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings.manage-content-settings');
    }
}