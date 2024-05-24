<?php

namespace App\Http\Livewire\Seller;

use App\Models\Seller\Gig;
use App\Models\Seller\GigPortfolio;
use Livewire\Component;

class SellerPortfolio extends Component
{
    public $seller;
    public function render()
    {
        $portfolios = Gig::join('gig_portfolios as g_p', 'g_p.gig_id', 'gigs.id')
        ->join('gig_details as g_d', 'g_d.gig_id', 'gigs.id')
        ->select(['gigs.id as gig_id','g_d.slug as slug', 'gigs.seller_id as seller_id', 'g_p.path', 'g_p.mime_type'])->where('seller_id', $this->seller->id)->get();

        if(count($portfolios) == 0){
            $this->skipRender();
        }
        return view('livewire.seller.seller-portfolio', compact('portfolios'));
    }
}
