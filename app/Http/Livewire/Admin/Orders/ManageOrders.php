<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use Livewire\Component;
use Livewire\WithPagination;

class ManageOrders extends Component
{
    use WithPagination;

    public $smallModal = false;
    public $buyerRequirements;

    public function showBuyerReqModal($id)
    {
        $this->buyerRequirements = OrderDetail::where('id',$id)->first()->buyer_requirements;
        $this->smallModal = true;
    }

    public function closeModal($modal)
    {
        $this->$modal = false;
        $this->buyerRequirements = "";
    }

    public function render()
    {
        $orders = Order::leftJoin('order_details as o_d','o_d.order_id','orders.id')
                        ->leftJoin('offers', 'offers.id', '=','orders.offer_id')
                        ->leftJoin('gigs', 'gigs.id', '=', 'orders.gig_id')
                        ->leftJoin('gig_details as g_d', 'g_d.gig_id', '=', 'gigs.id')
                        ->leftJoin('gig_images as g_i', function($join){
                            $join->on('g_i.gig_id','=','gigs.id')
                            ->where('g_i.image_type','=','M');
                        })
                        ->join('common_database.users as buyer', 'buyer.id', '=', 'orders.user_id')
                        ->join('sellers', 'sellers.id', '=', 'orders.seller_id')
                        ->selectRaw('
                            orders.id, orders.status,
                            g_d.title as gig_title,
                            g_i.image_path as gig_image,
                            o_d.amount, o_d.buyer_requirements, o_d.delivery_time,
                            buyer.name as buyer_name,
                            sellers.seller_name,
                            orders.type as orderType,
                            orders.offer_id as offer_id,
                            offers.title as offerTitle
                        ')
                        ->orderBy('orders.id','DESC')
                        ->paginate(20);

        return view('livewire.admin.orders.manage-orders', [
            'orders' => $orders
        ]);
    }
}
