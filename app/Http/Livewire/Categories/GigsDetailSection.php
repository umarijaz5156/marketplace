<?php

namespace App\Http\Livewire\Categories;

use App\Models\Category;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class GigsDetailSection extends Component
{
    use WithPagination;

    public $budgetFrom;
    public $budgetTo;
    public $sortField = 'average_rating';
    public $sortBy = false;
    public $catid;
    public $sellerLevel = [];
    public $sellerCountry;
    public $registerationDate;
    public $orderCount;
    public $deliveryTime = 0;
    public $search;
    public $rating;

    public function updatingBudgetFrom()
    {
        $this->resetPage();
    }

    public function updatingBudgetTo()
    {
        $this->resetPage();
    }

    public function updatingSellerLevel()
    {
        $this->resetPage();
    }

    public function updatingSellerCountry()
    {
        $this->resetPage();
    }


    public function updatingRegisterationDate()
    {
        $this->resetPage();
    }

    public function updatingDeliveryTime()
    {
        $this->resetPage();
    }


    public function updatingOrderCount(){
        $this->resetPage();
    }

    public function updatingSearch(){
        $this->resetPage();
    }


    public function clearFilters() {

        $this->reset(['budgetFrom', 'budgetTo', 'sellerLevel', 'rating']);
        $this->reset('sellerCountry');
        $this->reset('registerationDate');
        $this->reset('orderCount');
        $this->reset('deliveryTime');
        $this->reset('search');
    }

    public function render()
    {
        /* hint for tables shortcut
            [
                'c_g' => 'category_gig',
                'g' => 'gigs',
                'g_d' => 'gig_details',
                'g_i' => 'gig_images',
                'g_p' => 'gig_packages',
                's' => 'sellers',
                's_p' => 'seller_profiles',
                'r' => 'reviews',
            ]
        */
        $gigs = Category::join('category_gig as c_g','c_g.category_id', '=','categories.id') // multiple join on category and gig
                        ->join('gigs as g', function($join){
                            $join->on('g.id','c_g.gig_id')
                            ->where('g.is_approved', 1);
                        }) // multiple join on gig and category
                        ->join('gig_details as g_d', 'g_d.gig_id','=','g.id') // join on gig_details and gigs
                        ->join('gig_stats as g_s', 'g_s.gig_id', '=', 'g.id') //join on gig stats
                        ->join('sellers as s', 's.id', '=','g.seller_id') // join on gig and seller
                        ->join('seller_profiles as s_p', 's_p.seller_id','=','s.id')
                        ->join('seller_stats', 'seller_stats.seller_id', '=', 's.id')
                        ->join('common_database.users', 'users.id', '=', 's.user_id')
                        ->join('gig_packages as g_p', function($join){
                            $join->on('g_p.gig_id','=','g.id')
                            ->when($this->budgetFrom, function($query){
                                $query->where('price', '>=', $this->budgetFrom);
                            })
                            ->when($this->budgetTo, function($query){
                                $query->where('price', '<=', $this->budgetTo);
                            })
                            ->when($this->deliveryTime != 0 , function($query){
                                $query->where('type', 0)->where('delivery_days', '<=' , $this->deliveryTime);
                            });
                        }) // join on gig_packages and gigs
                        ->join('gig_images as g_i', function($join){ // join on gig_images and gigs
                            $join->on('g_i.gig_id','=','g.id')
                            ->where('g_i.image_type','M');
                        })
                        ->leftJoin('reviews as r','r.gig_id','=', 'g.id') //leftJoin on reviews and gig
                        ->selectRaw('
                            g_d.title as gig_title, g_d.slug,
                            MIN(g_p.price) as starting_at,
                            g_i.image_path,
                            s.id as seller_id,s.seller_name,s.seller_level,s.created_at,COUNT(seller_stats.orders_completed) as orders_completed,
                            users.profile_photo_path as seller_image,
                            g_s.reviews_average as reviews_average,
                            AVG(r.rating) as average_rating, COUNT(r.rating) as total_reviews,
                            users.id as user_id
                        ')
                        ->groupBy('g_p.gig_id','g_s.reviews_average','gig_title','g_i.image_path','s.id','s.seller_name','s.seller_level', 'g_d.slug', 's.created_at','users.profile_photo_path')
                        ->where('categories.id',$this->catid)
                        ->when($this->sellerLevel, function($query){
                            $query->whereIn('s.seller_level',$this->sellerLevel);
                        })
                        ->when($this->sellerCountry, function($query){
                            $query->where('s_p.country_id', $this->sellerCountry);
                        })
                        ->when($this->registerationDate, function($query){
                            $query->where('s.created_at', '<', $this->registerationDate);
                        })
                        ->when($this->orderCount, function($query){

                            $query->where('orders_completed','=',$this->orderCount);
                        })
                        ->when($this->search, function($query){
                            $query->where('g_d.title', 'LIKE', '%'.$this->search.'%');
                        })
                        ->when($this->rating, function($query){
                            $query->where('g_s.reviews_average', '>=', $this->rating);
                        })

                        ->orderBy($this->sortField, $this->sortBy ? 'ASC' : 'DESC')
                        ->paginate(9);

        return view('livewire.categories.gigs-detail-section', [
            'gigs'  =>  $gigs,
            'countries' => Country::all()
        ]);
    }
}
