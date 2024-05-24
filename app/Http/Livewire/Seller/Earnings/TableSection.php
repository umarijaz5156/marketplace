<?php

namespace App\Http\Livewire\Seller\Earnings;

use App\Enums\OrderStatus;
use App\Http\Traits\WithSorting;
use Livewire\Component;
use App\Models\Order\Order;
use App\Models\Seller\Seller;
use Livewire\WithPagination;

class TableSection extends Component
{
    use WithPagination;
    use WithSorting;


    public $selectedFilter;
    public $filters = [];
    public $COMMISSION = 20;

    public function render()
    {
        $seller =  Seller::where('user_id', auth()->user()->id)->first('id');
        $this->filters = OrderStatus::cases();
        $orders = Order::leftJoin('gigs' , 'gigs.id', '=', 'orders.gig_id')
                        ->leftJoin('gig_details', 'gig_details.gig_id', '=', 'gigs.id')
                        ->leftJoin('offers', 'offers.id', '=','orders.offer_id')
                        ->join('order_details', 'order_details.order_id', '=', 'orders.id')
                        ->selectRaw('
                        orders.id as id,
                        orders.seller_id as seller_id,
                        orders.created_at as created_at,
                        gig_details.title as title,
                        order_details.amount as amount,
                        order_details.total as total,
                        orders.status as status,
                        orders.type as orderType,
                        orders.offer_id as offer_id,
                        offers.title as offerTitle
                        ')->when($this->selectedFilter, function($query){

                                $query->where('orders.status',$this->selectedFilter);
                            })
                            ->where('orders.status' ,'!=', OrderStatus::UnPaid->value)

                        ->when($this->sortBy, function($query) {

                            $query->orderBy($this->sortBy, $this->sortDirection);

                       })
                       ->where('orders.seller_id', $seller->id)

                       ->paginate(5);


        return view('livewire.seller.earnings.table-section' , ['orders' => $orders]);
    }

    public function mount()
    {


        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
    }

    public function updatingSelectedFilter()
    {
        $this->resetPage();
    }
}
