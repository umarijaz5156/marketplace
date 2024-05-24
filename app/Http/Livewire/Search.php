<?php

namespace App\Http\Livewire;

use App\Models\Seller\Gig;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public $search;

    public $country;
    public $tags;

    public function mount(Request $request)
    {
        $this->search = $request->get('query');
        $this->country = $request->get('country');

    }

    public function render()
    {
        $gigs = Gig::join('gig_details as g_d', 'g_d.gig_id', '=', 'gigs.id')
                    ->join('gig_stats as g_s', 'g_s.gig_id', '=', 'gigs.id')
                    ->join('gig_images as g_i', function($join){ // join on gig_images and gigs
                        $join->on('g_i.gig_id','=','gigs.id')
                        ->where('g_i.image_type','M');
                    })
                    ->join('gig_packages as g_p','g_p.gig_id','=','gigs.id')
                    ->leftJoin('reviews as r','r.gig_id','=', 'gigs.id') //leftJoin on reviews and gig
                    ->join('sellers as s', 's.id', '=', 'gigs.seller_id')
                    ->join('seller_stats', 'seller_stats.seller_id', '=', 's.id')
                    ->join('seller_profiles as s_p', 's_p.seller_id', '=' ,'s.id')
                    ->join('common_database.users', 'users.id', '=', 's.user_id')
                    ->selectRaw('
                        g_d.title as gig_title, g_d.slug,
                        MIN(g_p.price) as starting_at,
                        s.is_approved,
                        g_i.image_path,
                        s.id as seller_id,s.seller_name, users.profile_photo_path as seller_image,
                        AVG(r.rating) as average_rating, COUNT(r.rating) as total_reviews,
                        s_p.country_id,
                        users.id as user_id,
                        gigs.is_active
                    ')
                    ->groupBy('g_p.gig_id', 's_p.country_id','g_d.title', 'g_d.slug', 'g_i.image_path', 's.id', 's.seller_name', 'users.profile_photo_path')
                    ->where('g_d.title', 'like', "%$this->search%")
                    ->when(isset($this->country), function($query){
                        $query->where('s_p.country_id', '=', $this->country);
                    })
                    ->where('s.is_approved', 1)
                    ->where('gigs.is_approved', 1)
                    ->where('gigs.is_active', true)
                    ->paginate(20);

        return view('livewire.search', ['gigs' => $gigs]);
    }

}
