<?php

namespace App\Http\Livewire\HomePage;

use App\Models\Seller\Gig;
use App\Models\Setting\PopularServicesHome;
use Livewire\Component;

class PopularServices extends Component
{
    public function render()
    {
        $popular_services_settings = PopularServicesHome::first();

        // show also viewed gigs on gig view page
        $query = Gig::join('gig_details as g_d', 'g_d.gig_id', '=', 'gigs.id')
                        ->join('gig_stats as g_s', 'g_s.gig_id', '=', 'gigs.id')
                        ->join('sellers as s', 's.id', '=', 'gigs.seller_id')
                        ->join('seller_stats as s_s', 's_s.seller_id', '=', 's.id')
                        ->join('common_database.users', 'users.id', '=', 's.user_id')
                        ->join('gig_images as g_i', function($join){
                            $join->on('g_i.gig_id','=','gigs.id')
                            ->where('g_i.image_type','M');
                        })
                        ->join('gig_packages as g_p', 'g_p.gig_id', '=', 'gigs.id')
                        ->selectRaw('
                            gigs.id,
                            g_d.slug, g_d.title as gig_title, g_d.description,
                            g_s.reviews_average as average_rating, g_s.reviews_count as total_reviews,
                            g_i.image_path,
                            s.seller_name,
                            users.profile_photo_path as seller_image,
                            users.is_online,
                            MIN(g_p.price) as starting_at,
                            users.id as user_id
                        ')
                        ->where('gigs.is_approved', 1)
                        ->where('s.is_approved', 1)
                        ->where('gigs.is_active', true)
                        ->groupBy('g_p.gig_id', 'users.is_online','gigs.id', 'g_d.slug', 'g_d.title', 'g_d.description', 'g_i.image_path', 'g_s.reviews_average', 'g_s.reviews_count', 's.seller_name', 'users.profile_photo_path')
                        ;

        $dataQuery = clone $query;
        $dataExtra = clone $query;

        if($popular_services_settings->status === 0){
            $data = $dataQuery
                    ->where('g_s.reviews_average','>=', $popular_services_settings->gig_rating)
                    ->where('g_s.order_completed', '>', $popular_services_settings->gig_orders)
                    ->where('s_s.orders_completed', '>', $popular_services_settings->seller_orders)
                    ->where('s_s.reviews_average', '>=', $popular_services_settings->seller_rating)
                    ->where('gigs.created_at', '>', $popular_services_settings->gig_add_date)
                    ->where('s.joined_on', '>', $popular_services_settings->seller_reg_date)
                    ->take($popular_services_settings->limit)
                    ->get();

            $totalGigs = clone $query;

            if(($data->count() < 4) && ($totalGigs->get()->count() > $data->count())){
                $dataExtra2 = $dataExtra->whereNotIn('gigs.id', $data->pluck('id'))
                                    // ->latest('gigs.created_at')
                                    ->orderBy('g_s.reviews_count')
                                    ->take($popular_services_settings->limit - $query->count())
                                    ->get();
                $data = $data->merge($dataExtra2);
            }
        } else {
           //  $data = $dataQuery->latest('gigs.created_at')->get();
           $data = $dataQuery->orderBy('g_s.reviews_count', 'desc')->orderBy('g_s.reviews_average', 'desc')->limit(12)->get();

        }


        if(!isset($data) || count($data) == 0 || empty($data)) {
            $this->skipRender();
        }

        return view('livewire.home-page.popular-services', [
            'gigs' => $data->unique()
        ]);
    }
}
