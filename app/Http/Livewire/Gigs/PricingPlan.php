<?php

namespace App\Http\Livewire\Gigs;

use Livewire\Component;
use App\Models\Seller\Seller;

class PricingPlan extends Component
{

    public $gig;
    public $basicPackage;
    public $standardPackage;
    public $premiumPackage;
    public $isOwner;

    public function render()
    {
        return view('livewire.gigs.pricing-plan');
    }

    public function mount()
    {
        $this->basicPackage = $this->gig->gigPackages->where('type', 0)->first();
        $this->standardPackage =  $this->gig->gigPackages->where('type', 1)->first();
        $this->premiumPackage =  $this->gig->gigPackages->where('type', 2)->first();
        $this->checkIsOwner();
    }

    public function checkIsOwner()
    {
        if(auth()->check()){
            $seller = Seller::where('id', $this->gig->seller_id)->first(['id', 'user_id']);
            if($seller){
                if($seller->user_id == auth()->user()->id){
                    $this->isOwner = true;
                } else{
                    $this->isOwner = false;
                }
            } else{
                $this->isOwner = false;
            }
        }

    }
}
