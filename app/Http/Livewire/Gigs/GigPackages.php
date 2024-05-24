<?php

namespace App\Http\Livewire\Gigs;

use App\Models\Seller\Seller;
use Livewire\Component;

class GigPackages extends Component
{
    public $gig;
    public $showAdvance;
    public $basicPackage;
    public $standardPackage;
    public $premiumPackage;
    public $basicPrice;
    public $standardPrice;
    public $premiumPrice;
    public $isOwner;

    public function render()
    {
        return view('livewire.gigs.gig-packages');
    }

    public function mount()
    {
       
        $this->showAdvance = $this->gig->package_type->value == 0 ? false : true;
        $this->basicPackage = $this->gig->gigPackages->where('type', 0)->first();
        $this->standardPackage =  $this->gig->gigPackages->where('type', 1)->first();
        $this->premiumPackage =  $this->gig->gigPackages->where('type', 2)->first();
        $this->basicPrice = $this->basicPackage?->price;
        $this->standardPrice = $this->standardPackage?->price;
        $this->premiumPrice = $this->premiumPackage?->price;
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
