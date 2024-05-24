<?php

namespace App\Http\Livewire\Admin;

use App\Enums\EmailTemplateType;
use App\Models\Log;
use App\Models\Newsletter;
use App\Models\Seller\Seller;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Sellers extends Component
{
    use WithPagination;

    public $search;
    public $filterDate;
    public $sortField = 'sellers.id';
    public $sortAsc = false;
    public $limit = 20;


    public $ConfirmStatusChangeModal = false;
    public $statusChangeInfo = ['statusValue' => 0, 'sellerId' => 0];
    public $showQualification = false;
    public $qualifications = [];
    public $verificationModal = false, $verificationStatus = ['title' => '', 'description' => ''];

    public function changeStatus($id, $status)
    {
        $this->statusChangeInfo['sellerId'] = $id;
        $this->statusChangeInfo['statusValue'] = !$status;
        $this->ConfirmStatusChangeModal = true;
    }

    public function confirmedChangeStatus()
    {
        if(Seller::where('id', '=', $this->statusChangeInfo['sellerId'])->update(['is_approved' => $this->statusChangeInfo['statusValue']])){

            // send seller approve and disapproved email
            if($seller = Seller::find($this->statusChangeInfo['sellerId'])){
                $seller = $seller->load('user');

                // send email to seller when is approved
                if($seller->is_approved){
                    if($mailData = Newsletter::where('type', EmailTemplateType::SellerApproved->value)->first()){
                        $this->sendMail($mailData, $seller);
                    }
                } else { // send email to seller when is disapproved
                    if($mailData = Newsletter::where('type', EmailTemplateType::SellerDisapproved->value)->first()){
                        $this->sendMail($mailData, $seller);
                    }
                }
            }

        }

        $this->statusChangeInfo = ['statusValue' => 0, 'sellerId' => 0];
        $this->ConfirmStatusChangeModal = false;
    }

    public function sendMail($mailData, $seller)
    {
        $subject = $mailData->subject;
        $body = $mailData->body;


        $body = str_replace('{{seller}}', $seller->seller_name, $body);

        $data = ['body' => $body, 'subject' => $subject];

        dispatch(new \App\Jobs\SendEmailJob($data, $seller->user->email));
    }

    // Close Modal Function
    public function closeModal($modal)
    {
        $this->$modal = false;
    }

    // Custom filtering
    public function filterBy($value)
    {
        $this->sortAsc = false;

        if (empty($value)) {
            $this->sortField = 'sellers.id';
        } else {
            $this->sortField = $value;
        }
    }

    // custom sorting
    public function sortBy($value)
    {
        if ($this->sortField === $value) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $value;
    }

    public function render()
    {
        return view('livewire.admin.sellers', [
            'sellers' => Seller::select(
                "sellers.id",
                "sellers.seller_name",
                "users.email",
                "sellers.is_approved",
                "sellers.gigs_count",
                "sellers.seller_level",
                "sellers.created_at",
                "sellers.stripe_onboarded",
                'sellers.verification_status',
                "stat.total_orders",
                "stat.orders_completed",
                "stat.orders_canceled",
                "stat.money_earned",
                "stat.total_reviews",
                "stat.reviews_average"
            )
                ->join('seller_profiles as profile', 'sellers.id', '=', 'profile.seller_id')
                ->join('seller_stats as stat', 'sellers.id', '=', 'stat.seller_id')
                ->join('common_database.users', 'users.id', '=', 'sellers.user_id')

                ->where(function ($query) {
                    $query->where('sellers.seller_name', 'like', '%' . $this->search . '%')
                        ->orWhere('sellers.gigs_count', 'like', '%' . $this->search . '%')
                        ->orWhere('sellers.seller_level', 'like', '%' . $this->search . '%')
                        ->orWhere('stat.money_earned', 'like', '%' . $this->search . '%')
                        ->orWhere('sellers.created_at', 'like', '%' . $this->search . '%')
                        ->orWhere('users.email', 'like', '%' . $this->search . '%');
                })
                ->where(function ($query) {
                    $query->when($this->filterDate == 1, function ($query) {
                        $query->whereDate('sellers.created_at', '=', Carbon::yesterday());
                    })
                        ->when($this->filterDate == 2, function ($query) {
                            $query->whereBetween('sellers.created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                        })
                        ->when($this->filterDate == 3, function ($query) {
                            $query->whereMonth('sellers.created_at', '=', Carbon::now()->subMonth());
                        })
                        ->when($this->filterDate == 4, function ($query) {
                            $query->whereYear('sellers.created_at', '=', Carbon::now()->subYear());
                        });
                })
                // ->groupBy('gigs.is_approved','gigs.seller_id')
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'ASC' : 'DESC');
                })
                ->paginate($this->limit)
        ]);
    }

    public function showQualification($seller){
        $this->showQualification = true;
        $this->reset('qualifications');
        $this->qualifications = Seller::find($seller)->qualifications;

    }

    public function openVerficationStatus($seller){
       $log = Log::where('content_type', 'seller')->where('content_id', $seller)->latest()->take(1)->first();

      if($log){
        $this->verificationStatus['title'] = $log->title;
        $this->verificationStatus['description'] = $log->description;
        $this->verificationModal = true;
      }

    }
}
