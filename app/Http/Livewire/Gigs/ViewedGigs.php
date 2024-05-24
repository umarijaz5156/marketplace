<?php

namespace App\Http\Livewire\Gigs;

use App\Models\Seller\Gig;
use App\Models\Setting\AlsoViewed;
use Livewire\Component;

class ViewedGigs extends Component
{
    public function render()
    {
        // show also viewed gigs on gig view page
        $also_viewed_settings = AlsoViewed::first();

        $query2 = Gig::join('gig_details as g_d', 'g_d.gig_id', '=', 'gigs.id')
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
                            gigs.id, gigs.created_at,
                            g_d.slug, g_d.title as gig_title,
                            g_s.reviews_average as average_rating, g_s.reviews_count as total_reviews,
                            g_i.image_path,
                            MIN(g_p.price) as starting_at,
                            s.id as seller_id, s.seller_name, users.profile_photo_path as seller_image
                        ')
            ->groupBy('g_p.gig_id', 'gigs.id', 'gigs.created_at', 'g_d.slug', 'g_d.title', 'g_s.reviews_average', 'g_s.reviews_count', 'g_i.image_path', 's.id', 's.seller_name', 'users.profile_photo_path')
            ->where('gigs.is_approved', 1)->where('gigs.is_active', true);

        $alsoViewedGigsQuery = clone $query2;
        $alsoViewdExtra = clone $query2;

        if ($also_viewed_settings->status == 0) {
            $alsoViewedGigs = $alsoViewedGigsQuery->where('g_s.reviews_average', '>=', $also_viewed_settings->gig_rating)
                ->where('g_s.order_completed', '>', $also_viewed_settings->gig_orders)
                ->where('s_s.orders_completed', '>', $also_viewed_settings->seller_orders)
                ->where('s_s.reviews_average', '>=', $also_viewed_settings->seller_rating)
                ->where('gigs.created_at', '>', $also_viewed_settings->gig_add_date)
                ->where('s.joined_on', '>', $also_viewed_settings->seller_reg_date)
                ->take($also_viewed_settings->gigs_limit)
                ->get();

            $totalGigs = clone $query2;

            // merge latest gigs if above query count is less than 4 record
            if ($alsoViewedGigs->count() < 4 && $totalGigs->get()->count() > $alsoViewedGigs->count()) {
                $alsoViewdExtra2 = $alsoViewdExtra->whereNotIn('gigs.id', $alsoViewedGigs->pluck('id'))
                    ->latest('gigs.created_at')
                    ->take($also_viewed_settings->gigs_limit - $alsoViewedGigs->count())
                    ->get();
                $alsoViewedGigs = $alsoViewedGigs->merge($alsoViewdExtra2);
            }
        } else {
            $alsoViewedGigs = $alsoViewedGigsQuery->latest('created_at')->take(4)->get();
        }

        if(!isset($alsoViewedGigs) || count($alsoViewedGigs) === 0 || empty($alsoViewedGigs)) {
            $this->skipRender();
        }

        return view('livewire.gigs.viewed-gigs', ['alsoViewedGigs' => $alsoViewedGigs]);
    }
}
