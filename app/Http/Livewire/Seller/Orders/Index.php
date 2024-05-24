<?php

namespace App\Http\Livewire\Seller\Orders;

use Carbon\Carbon;
use Livewire\Component;
use App\Enums\OrderStatus;
use App\Http\Traits\WithSorting;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use App\Models\Seller\GigPackage;
use Livewire\WithPagination;
use App\Models\Seller\Seller;

class Index extends Component
{
    use WithSorting;
    use WithPagination;


    public $statusFilters = [];
    public $selectedFilter = 0;
    public $limit = 10;
    // public $sortField = 'order_id';
    // public $sortAsc = false;

    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        $this->statusFilters = OrderStatus::cases();
        $seller_id = Seller::where('user_id', auth()->user()->id)->get('id');
        $this->sortBy = 'order_id';
        $this->sortDirection = 'desc';
        $orders =
           Order::leftJoin('gigs','gigs.id', '=', 'orders.gig_id')
           ->leftJoin('offers', 'offers.id', '=','orders.offer_id')
           ->leftJoin('gig_details', 'gig_details.gig_id', '=', 'gigs.id')
           ->leftJoin('gig_images', function($join){
               $join->on('gig_images.gig_id', '=', 'orders.gig_id')
               ->where('gig_images.image_type', '=' ,'M');
           })
           ->leftJoin('order_details', 'order_details.order_id', '=', 'orders.id')
           ->leftjoin('common_database.users', 'orders.user_id', '=', 'users.id')
           ->selectRaw('
                users.name as user_name,
               orders.user_id as user_id,
               orders.id as order_id,
               orders.seller_id as seller_id,
               gigs.id as gig_id,
               gig_details.title as gigTitle,
               order_details.delivery_time as deliveryTime,
               gig_images.image_path as imagePath,
               orders.created_at as created_at,
               order_details.amount as orderAmount,
               orders.status as orderStatus,
               orders.type as orderType,
               orders.offer_id as offer_id,
               offers.title as offerTitle

           ')
           ->when($this->selectedFilter != 0 , function($query){
               $query->where('orders.status', $this->selectedFilter);

           })
           ->where('orders.status' ,'!=', OrderStatus::UnPaid->value)
           ->when($this->sortBy, function($query) {

                $query->orderBy($this->sortBy, $this->sortDirection);

           })

           ->where('orders.seller_id', $seller_id->first()->id)

           ->paginate($this->limit);

        return view('livewire.seller.orders.index',[
            'orders' => $orders
        ])->layout('components.seller.dashboard-layout');
    }

    public function statusFilter($filter)
    {
        $this->selectedFilter = $filter;
    }

    public function convertDate($date)
    {
        return Carbon::parse($date);
    }

    public function acceptOrder($order_id)
    {
        if($order_id) {
            $order = Order::find($order_id);
            $order->status = OrderStatus::InProgress;
            $order->save();


            $order_details = OrderDetail::where('order_id', $order->id)->first();
            $gig_package = GigPackage::where('id', $order_details->gig_package_id)->first();
            $deliveryTime = Carbon::now()->addDays($gig_package->delivery_days);
            $order_details->delivery_time = $deliveryTime;
            $order_details->save();

            session()->flash('message', 'Order Accepted Successfully');
            session()->flash('messageLink', $order->id);

        }

    }

    public function redirectTo($id)
    {
        redirect(route('order_details' , ['id' => $id]));
    }

    public function updatingLimit()
    {
        $this->resetPage();
    }
}
