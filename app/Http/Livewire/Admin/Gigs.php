<?php

namespace App\Http\Livewire\Admin;

use App\Models\Review;
use App\Models\Seller\Gig;
use App\Models\Seller\GigStat;
use App\Models\Seller\Seller;
use App\Models\Seller\SellerStat;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Gigs extends Component
{
    use WithPagination;

    public $search;
    public $limit =20;
    public $filterDate;
    public $sortField = 'gigs.id';
    public $sortAsc = false;
    public $gigId;
    public $deleteConfirmModal = false;
    public $ConfirmStatusChangeModal = false;
    public $statusChangeInfo = ['statusValue' => 0, 'gigId' => 0];
    public $reviewGigId;
    public $openReviewModal = false;
    public $comment = '';
    public $rating = 5;
    public $users, $selectedUser;
    public $date;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLimit()
    {
        $this->resetPage();
    }

    public function updatingFilterDate()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function changeStatus($id, $status)
    {
        $this->statusChangeInfo['gigId'] = $id;
        $this->statusChangeInfo['statusValue'] = !$status;
        $this->ConfirmStatusChangeModal = true;
    }

    public function confirmedChangeStatus()
    {
        Gig::where('id','=',$this->statusChangeInfo['gigId'])->update(['is_approved'=>$this->statusChangeInfo['statusValue']]);
        $this->ConfirmStatusChangeModal = false;
        $this->statusChangeInfo = ['statusValue' => 0, 'gigId' => 0];
    }

    // Close Modal Function
    public function closeModal($modal)
    {
        $this->$modal = false;
    }

    // Save Deleting Gig Id
    public function deleteGig($id) {
        $this->gigId = $id;
        $this->deleteConfirmModal = true;
    }

// Delete Gig
    public function delete() {
        if($gig = Gig::find($this->gigId)){ // find gig by ID

            if($gig->orders()->exists()){
                session()->flash('error', 'Cannot delete this gig it has order');
            } else{
                if($gig->delete()){ // deleting the gig
                    foreach($gig->gigImages as $image)
                    {
                        if($image->image_path){
                            Storage::disk('gigs')->delete($image->image_path);
                        }

                    }
                    $seller = $gig->seller()->decrement('gigs_count'); // update the seller total gigs
                }

                session()->flash('success', 'Service deleted successfully.');
            }

        }

        $this->deleteConfirmModal = false;
    }

    public function render()
    {
        $gigs = Gig::join('sellers','sellers.id','=','gigs.seller_id')
                    ->join('gig_details','gig_details.gig_id','=','gigs.id')
                    ->join('gig_stats','gig_stats.gig_id','=','gigs.id')
                    ->selectRaw('
                        sellers.seller_name,
                        gig_details.title as gig_title, gig_details.slug,
                        gig_stats.order_count, gig_stats.order_cancelled, gig_stats.order_completed, gig_stats.reviews_count, gig_stats.reviews_average, gig_stats.money_earned,
                        gigs.id as gig_id ,gigs.is_approved ,gigs.created_at, gigs.is_active
                    ')
                    ->when($this->filterDate == 1, function($query){
                        $query->whereDate('gigs.created_at','=',Carbon::yesterday());
                    })
                    ->when($this->filterDate == 2, function($query){
                        $query->whereBetween('gigs.created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
                    })
                    ->when($this->filterDate == 3, function($query){
                        $query->whereMonth('gigs.created_at','=',Carbon::now()->subMonth());
                    })
                    ->when($this->filterDate == 4, function($query){
                        $query->whereYear('gigs.created_at','=',Carbon::now()->subYear());
                    })
                    ->where(function($query) {
                        $query->where('gig_details.title','like','%'.$this->search.'%')
                        ->orWhere('seller_name','like','%'.$this->search.'%')
                        ->orWhere('reviews_average','like','%'.$this->search.'%')
                        ->orWhere('reviews_count','like','%'.$this->search.'%')
                        ->orWhere('money_earned','like','%'.$this->search.'%');
                    })
                    ->when($this->sortField, function($query) {
                        $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                    })

                    ->paginate($this->limit);

        return view('livewire.admin.gigs', ['gigs' => $gigs]);
    }

    public function openReviewModal($gigId)
    {
        $this->reviewGigId = $gigId;
        $this->openReviewModal = true;
    }

    public function mount()
    {
        $this->users = User::where('is_banned', false)->get(['id', 'name']);

    }

    public function addReview(){

        try{
            $gig = Gig::find($this->reviewGigId);
            Review::create([
                'rating' => $this->rating,
                'review' => $this->comment,
                'gig_id' => $gig->id,
                // 'order_id' => $this->order->id,
                'from_user_id' =>  $this->selectedUser == null ? auth()->user()->id : $this->selectedUser,
                'to_user_id' => $gig->seller->user_id,
                'review_type' => 'buyer',
                'created_at' => $this->date ?? Carbon::now()
            ]);

            $sellerStat = SellerStat::where('seller_id', $gig->seller_id)->first();

            $sellerStat->reviews_average = $this->reviewsAvgCalc($sellerStat->reviews_average, $sellerStat->total_reviews, $this->rating);
            $sellerStat->total_reviews += 1;
            $sellerStat->save();

            // update gig stats
            $gigStats = GigStat::where('gig_id', $gig->id)->first();

            $gigStats->reviews_average = $this->reviewsAvgCalc($gigStats->reviews_average, $gigStats->reviews_count, $this->rating);
            $gigStats->reviews_count += 1;
            $gigStats->save();
            $this->toggleModal();
            session()->flash('success', 'Review Added Successfully deleted successfully.');
        } catch(Exception $e){
            session()->flash('error', 'Error occured while adding review');
        }




    }

    public function reviewsAvgCalc($prev_reviews_avg, $prev_reviews_count, $new_review)
    {
        // ((prev_reviews_avg * $prev_reviews_count) + new_review) / prev_reviews_count + 1
        return (($prev_reviews_avg * $prev_reviews_count) + $new_review) / ++$prev_reviews_count;
    }

    public function toggleModal(){
        $this->reset(['reviewGigId', 'selectedUser', 'comment', 'rating','openReviewModal']);
    }

}
