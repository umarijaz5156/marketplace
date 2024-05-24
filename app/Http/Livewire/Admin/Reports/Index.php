<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Enums\ReportType;
use App\Models\Report;
use App\Models\Seller\GigDetail;
use App\Models\Seller\Seller;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    

    public $openModal;
    public $details;
    public $filters;
    public $selectedFilter = 0;


    public function updatedSelectedFilter(){
        $this->resetPage();
    }

    public function render()
    {
      $this->filters = ReportType::cases();
        return view('livewire.admin.reports.index', [
            'reports' =>   $this->getReports()
        ])->layout('components.admin-layout');
    }

    public function mount()
    {
        $this->openModal = false;
    }

    public function getReports()
    {
        return Report::latest()
        ->when($this->selectedFilter != 0, function($query){
            $query->where('content_type', $this->selectedFilter);
        })
        ->paginate(20);
    }

    public function getUser($id,$type)
    {
        if($type == ReportType::Buyer->value){
            $seller = Seller::where('id', $id)->first(['seller_name']);
            return $seller->seller_name;
          
        } elseif($type == ReportType::Seller->value){
            $user = User::where('id', $id)->first(['name']);
            return $user->name;
        } 
    }

    public function getSellerName($id)
    {
        $seller = Seller::where('id', $id)->first(['seller_name']);
        return $seller->seller_name;
    }

    public function getGigTitle($id)
    {
        $gig = GigDetail::where('gig_id', $id)->first(['slug']);
        return $gig->slug;
    }

    public function showReportDetails($details)
    {
        
        $this->details = $details;
        $this->openModal = true;
    }
}
