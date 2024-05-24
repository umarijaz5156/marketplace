<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ConfigHome;
use App\Models\Seller\Seller;
use App\Models\Setting\OurFreelancersForHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
    {


        $home = ConfigHome::first();
        $popularCategories = null;
        $heroSection = ConfigHome::select('title', 'description', 'header_image')->first();

        // if ($home->status1 === 1) {

        //     $popularCategories = Category::select('id','name')->whereIn('id', explode(',', $home->category_ids))->get();
        // } else {
        //     if($home->popular_categories_filter == 1) {
        //         $popularCategories = Category::select('id','name')->whereNull('parent_id')->withCount('gigs')->orderByDesc('gigs_count')->take(10)->get();

        //     } elseif($home->popular_categories_filter == 2) {

        //     } else {
        //         $popularCategories = [];
        //     }
        // }

        $popularCategories = Category::select('id','name')->whereNull('parent_id')->withCount('gigs')->orderByDesc('gigs_count')->take(8)->get();
        $our_freelancers_settings = OurFreelancersForHome::first();

        $query = Seller::join('common_database.users', 'users.id', '=', 'sellers.user_id')
                        ->join('seller_profiles as s_p', 's_p.seller_id', '=', 'sellers.id')
                        ->join('seller_stats as s_s', 's_s.seller_id', '=', 'sellers.id')
                        ->selectRaw('
                            sellers.id as seller_id, sellers.seller_name,
                            s_p.description,
                            users.profile_photo_path
                        ');
                        // ->whereNotNull('users.profile_photo_path')

        $freelancersQuery = clone $query;
        $freelancersExtra = clone $query;

        if($our_freelancers_settings->status === 0){
            $freelancers = $freelancersQuery
                            ->where('s_s.reviews_average', '>=', $our_freelancers_settings->seller_rating)
                            ->where('s_s.orders_completed', '>', $our_freelancers_settings->seller_orders)
                            ->where('sellers.joined_on', '>', $our_freelancers_settings->seller_reg_date)
                            ->take($our_freelancers_settings->limit)
                            ->get();

            $totalFreelancers = clone $query;

            if(($freelancers->count() < 4) && ($totalFreelancers->get()->count() > $freelancers->count())){
                $freelancersExtra2 = $freelancersExtra
                                    ->whereNotIn('sellers.id', $freelancers->pluck('seller_id'))
                                    ->latest('sellers.created_at')
                                    ->take($our_freelancers_settings->limit - $freelancers->count())
                                    ->get();

                $freelancers = $freelancers->merge($freelancersExtra2);
            }
        } else {
            $freelancers = $freelancersQuery->latest('sellers.created_at')->take(4)->get();
        }
        //
        // to change version of home change this
        // V1 => homepage
        // V2 => homepageV2
        return view('homepage', compact('heroSection', 'popularCategories', 'freelancers'));
    }


    public function getCookie(Request $request)
    {

        // Cookie::forget('affiliate_key');
        Cookie::queue(  Cookie::forget('affiliate_key'));


    }


}
