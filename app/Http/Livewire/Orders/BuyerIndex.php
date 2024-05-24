<?php

namespace App\Http\Livewire\Orders;

use App\Enums\ImageType;
use App\Enums\OrderStatus;
use App\Http\Traits\WithSorting;
use App\Models\Order\Order;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class BuyerIndex extends Component
{

    use WithPagination;
    use WithSorting;


    public $statusFilters = [];
    public $selectedFilter = 'In Progress';
    public $sortField = 'order_id';
    public $sortAsc = false;
    public $active = 0;

    public function render()
    {

         $this->statusFilters = OrderStatus::cases();
         $orders =
            Order::leftJoin('gigs','gigs.id', '=', 'orders.gig_id')
            ->leftJoin('offers', 'offers.id', '=','orders.offer_id')
            ->leftJoin('gig_details', 'gig_details.gig_id', '=', 'gigs.id')
            ->leftJoin('gig_images', function($join){
                $join->on('gig_images.gig_id', '=', 'orders.gig_id')
                ->where('gig_images.image_type', '=' ,'M');
            })
            ->join('order_details', 'order_details.order_id', '=', 'orders.id')
            ->selectRaw('
                orders.user_id as user_id,
                orders.id as order_id,
                gigs.id as gig_id,
                gig_details.title as gigTitle,
                order_details.delivery_time as deliveryTime,
                gig_images.image_path as imagePath,
                orders.created_at as orderCreatedAt,
                order_details.amount as orderAmount,
                orders.status as orderStatus,
                orders.type as orderType,
                orders.offer_id as offer_id,
                offers.title as offerTitle
            ')
            // ->when($this->selectedFilter, function($query){
            //     $query->where('orders.status', $this->selectedFilter);

            // })
            ->where('orders.status', $this->selectedFilter)
            ->where('orders.status' ,'!=', OrderStatus::UnPaid->value)
            ->when($this->sortField, function($query) {
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            })

            ->where('orders.user_id', auth()->user()->id)

            ->paginate(5);


        return view('livewire.orders.buyer-index', [
            'orders' => $orders
        ]);


    }

    public function sortBy($field) {
        if($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function convertDate($date)
    {
        return Carbon::parse($date);
    }

    public function statusColor($status){

        if($status == OrderStatus::InProgress->value) {

            return 'bg-purple-200 text-purple-600';
        }
        elseif ($status == OrderStatus::Pending->value) {
            return 'bg-red-200 text-red-600';
        }
        elseif ($status == OrderStatus::Completed->value) {
            return 'bg-green-200 text-green-600';
        }
        elseif ($status == OrderStatus::Delivered->value) {

            return 'bg-yellow-200 text-yellow-600';
        }
    }

    public function changeStatus($value,$index)
    {

        $this->selectedFilter = $value;
        $this->active = $index;
    }


}
