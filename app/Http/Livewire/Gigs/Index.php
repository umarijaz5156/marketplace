<?php

namespace App\Http\Livewire\Gigs;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Review;
use Livewire\Component;
use App\Models\Seller\Gig;
use App\Models\Seller\Seller;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public $reviewGigId;
    public $deleteGigId;
    public $confirmingItemAdd;
    public $confirmingItemDelete;
    public $filterDate=0;
    public $seller_id;

    public $pauseGig;
    public $confirmingItemPause = false;

    public function render()
    {

        return view('livewire.gigs.index', [

            'gigs' =>
            Gig::when($this->filterDate == 0, function($query){
                $query->where('seller_id', Auth::user()->seller->id)->latest();

            })
            ->when($this->filterDate == 1, function($query){
                $query
                   ->whereDate('created_at', [Carbon::now()->yesterday()])
                   ->where('seller_id', Auth::user()->id);
            })
            ->when($this->filterDate == 2, function($query){
                $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                    ->where('seller_id', Auth::user()->id);
            })
            ->when($this->filterDate == 3, function($query){
                $query->whereMonth('created_at','=',Carbon::now()->subMonth())
                ->where('seller_id', Auth::user()->id);
            })
            ->when($this->filterDate == 4, function($query){
                $query->whereYear('created_at','=',Carbon::now()->subYear())
                ->where('seller_id', Auth::user()->id);;
            })
            ->with(['gigDetail','seller', 'gigStat', 'gigImages' => function($query){
                $query->where('image_type','M');
            }])
            ->paginate(10, ['*'], 'gig-page')


        ]);

    }

    public function mount()
    {
        $this->confirmingItemAdd  = false;
    }


    public function confirmItemAdd($id)
    {
        $this->emit('selectedGig',$id);
        $this->reviewGigId = $id;
        $this->confirmingItemAdd = true;

    }

    public function confirmItemDelete($id)
    {
        $this->deleteGigId= $id;
        $this->confirmingItemDelete = true;
    }

    public function pauseGigModal($id){
        $this->pauseGig = Gig::findOrFail( $id );
        $this->confirmingItemPause = true;
    }

    public function pauseGig()
    {
        if($this->pauseGig){
            if($this->pauseGig->is_active){
                Gig::find($this->pauseGig->id)->update(['is_active' => false]);
            } else{
                Gig::find($this->pauseGig->id)->update(['is_active' => true]);
            }
            $message = 'Status updated successfully';
            $response = [
                'message' => $message,
                'type' => 'success'
            ];

            session()->flash('message', $response);
            $this->reset(['pauseGig', 'confirmingItemPause']);
        }
    }



    public function deleteGig()
    {
        // delete all photo of gig
        $gig = Gig::with('gigImages')->where('id', $this->deleteGigId)->firstOrFail();
        if($gig->orders()->exists()){
            $this->confirmingItemDelete = false;
            $message = 'Gig has order cannot be deleted';
            $response = [
                'message' => $message,
                'type' => 'error'
            ];

            session()->flash('message', $response);
            return 0;
        }
        foreach($gig->gigImages as $image)
        {
            if($image->image_path){
                Storage::disk('gigs')->delete($image->image_path);
            }

        }
        $gig->delete();

        // less gig count
        Seller::find($gig->seller_id)->decrement('gigs_count');

        $this->confirmingItemDelete = false;
        $message = 'Gig Deleted Successfully';
        $response = [
            'message' => $message,
            'type' => 'success'
        ];
        session()->flash('message', $response);
    }

    public function closeDeleteModal()
    {
        $this->confirmingItemDelete = false;
    }

    public function closePauseModal()
    {
        $this->reset(['pauseGig', 'confirmingItemPause']);
    }

}
