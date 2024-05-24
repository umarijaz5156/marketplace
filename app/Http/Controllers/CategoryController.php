<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Seller\Seller;
use App\Models\Setting\OurFreelancersForHome;

class CategoryController extends Controller
{
    public function index($catId)
    {
        $category = Category::with([
            'parentCategory',
            'childCategories' => function ($query) {
                $query->with(['detail' => function ($query) {
                    $query->select('id', 'category_id', 'tagline', 'icon', 'cover_photo');
                }]);
            },
            'gigs' => function($query){
                $query->with('seller', function($query) {
                    $query->where('is_approved', 1);
                });
                // $query->with(['seller' => function ($query){
                //     $query->where('is_approved', 1);
                // }]);
                // $query->where('is_approved',1);
            }, 'detail' => function ($query) {
                $query->select('id', 'category_id', 'tagline', 'icon', 'cover_photo');
            }
        ])
        ->whereHas('gigs', function($query) {

            $query->where('is_approved', true)
            ->whereHas('seller', function($q) {
                $q->where('is_approved', 1);
            });
        })
        ->where('id', $catId)
        ->first();

        $our_freelancers_settings = OurFreelancersForHome::first();
        $query = Seller::join('common_database.users', 'users.id', '=', 'sellers.user_id')
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
        ->where('sellers.gigs_count', '>', 0);


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

        return view('category', compact('category', 'freelancers'));
    }
}
