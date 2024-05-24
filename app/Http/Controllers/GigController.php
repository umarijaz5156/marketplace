<?php

namespace App\Http\Controllers;

use App\Models\Seller\Gig;
use App\Models\Seller\GigDetail;
use App\Models\Seller\Seller;
use App\Models\Setting\AlsoViewed;
use App\Models\Setting\GigViewPageRcmndedGig;
use App\Models\Setting\OurFreelancersForGigView;
use Illuminate\Support\Facades\Artisan;

class GigController extends Controller
{
    /**
     * index page for gigs
     */
    public function index()
    {

        return view('gig.index');
    }

    public function details($slug)
    {

        $gigId = GigDetail::where('slug', $slug)->firstOrFail()->gig_id;

        // Show gig detail on gig view page
        $gig  = Gig::with([
            'gigDetail', 'gigImages', 'gigStat', 'gigPackages', 'gigFaqs', 'gigReviews', 'mainImage',
            'seller' => function ($query) {
                $query->with('sellerStat');
            }
        ])
            // ->where('id', $gigId)
            ->findOrFail($gigId);


        $this->authorize('view', $gig);

        $rcmnded_gig_settings = GigViewPageRcmndedGig::first();

        // Show recommended gigs on gig view page
        $query = Gig::join('gig_details as g_d', 'g_d.gig_id', '=', 'gigs.id')
            ->join('gig_stats as g_s', 'g_s.gig_id', '=', 'gigs.id')
            ->join('sellers as s', 's.id', '=', 'gigs.seller_id')
            ->join('seller_stats as s_s', 's_s.seller_id', '=', 's.id')
            ->join('common_database.users', 'users.id', '=', 's.user_id')
            ->join('gig_images as g_i', function ($join) {
                $join->on('g_i.gig_id', '=', 'gigs.id')
                    ->where('g_i.image_type', 'M');
            })
            ->join('gig_packages as g_p', 'g_p.gig_id', '=', 'gigs.id')
            ->selectRaw('
                            gigs.id, g_d.slug, g_d.title as gig_title,
                            g_s.reviews_average as average_rating, g_s.reviews_count as total_reviews,
                            g_i.image_path,
                            MIN(g_p.price) as starting_at,
                            s.id as seller_id, s.seller_name, users.profile_photo_path as seller_image
                        ')
            ->groupBy('g_p.gig_id', 'g_d.slug', 'g_d.title', 'gigs.id', 'g_s.reviews_average', 'g_s.reviews_count', 'g_i.image_path', 's.id', 's.seller_name', 'users.profile_photo_path')
            ->where('gigs.is_approved', 1)->where('s.is_approved', 1)->where('is_active', true);

        $recommendedQuery =  clone $query; // cloning query to apply more conditions on it
        $newRecord = clone $query; // cloning query to apply more conditions on it

        if ($rcmnded_gig_settings->status === 0) { // if settings are not disabled from admin panel

            // query filter according to admin requirements criteria
            $recommended = $recommendedQuery
                ->where('g_s.order_completed', '>', $rcmnded_gig_settings->gig_orders)
                ->where('g_s.reviews_average', '>=', $rcmnded_gig_settings->gig_rating)
                ->where('s_s.orders_completed', '>', $rcmnded_gig_settings->seller_orders)
                ->where('s_s.reviews_average', '>=', $rcmnded_gig_settings->seller_rating)
                ->where('gigs.created_at', '>', $rcmnded_gig_settings->gig_add_date)
                ->where('s.joined_on', '>', $rcmnded_gig_settings->seller_reg_date)
                ->take($rcmnded_gig_settings->gigs_limit)
                ->get();

            $totalGigs = clone $query;

            // merge latest gigs if above query count is less than 4
            if (($recommended->count() < 4) && $totalGigs->get()->count() > $recommended->count()) {
                $newRecord2 = $newRecord->whereNotIn('gigs.id', $recommended->pluck('id'))->latest('gigs.created_at')->take($rcmnded_gig_settings->gigs_limit - $recommended->count())->get();
                $recommended = $recommended->merge($newRecord2);
            }
        } else { // if settings are disable from admin panel then take latest 5 gigs
            $recommended = $recommendedQuery->latest('gigs.created_at')->take(4)->get();
        }

        // Our Freelancers
        $our_freelancers_settings = OurFreelancersForGigView::first();

        $query3 = Seller::join('common_database.users', 'users.id', '=', 'sellers.user_id')
            ->join('seller_profiles as s_p', 's_p.seller_id', '=', 'sellers.id')
            ->join('seller_stats as s_s', 's_s.seller_id', '=', 'sellers.id')
            ->selectRaw('
                sellers.id as seller_id, sellers.seller_name,
                s_p.description,
                users.profile_photo_path
            ')->where('sellers.is_approved', true)
            ->whereHas('gigs', function($query) {

                $query->where('is_approved', true);
            })
            ->where('sellers.gigs_count', '>', 0);;
            // ->whereNotNull('users.profile_photo_path');

        $freelancersQuery = clone $query3;
        $freelancersExtra = clone $query3;

        if($our_freelancers_settings->status === 0){
            $freelancers = $freelancersQuery
                        ->where('s_s.reviews_average', '>=', $our_freelancers_settings->seller_rating)
                        ->where('s_s.orders_completed', '>', $our_freelancers_settings->seller_orders)
                        ->where('sellers.joined_on', '>', $our_freelancers_settings->seller_reg_date)
                        ->take($our_freelancers_settings->limit)
                        ->get();

            $totalSellers = clone $query3;

            if(($freelancers->count() < 4) && ($totalSellers->get()->count() > $freelancers->count())){
                $freelancersExtra2 = $freelancersExtra
                                    ->whereNotIn('sellers.id', $freelancers->pluck('seller_id'))
                                    ->latest('sellers.created_at')
                                    ->take($our_freelancers_settings->limit - $freelancers->count())
                                    ->get();

                $freelancers = $freelancers->merge($freelancersExtra2);
            }
        } else {
            $freelancers = $freelancersQuery->orderBy('s_s.reviews_average', 'desc')->orderBy('s_s.orders_completed', 'desc')->limit(4)->get();
        }

        return view('gig.details', compact('gig', 'recommended', 'freelancers'));
    }
}
