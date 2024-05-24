<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Enums\OrderStatus;
use App\Models\Seller\Gig;
use Livewire\Component;

class TopGigs extends Component
{
    public function render()
    {
        $gigs = Gig::join('gig_details as g_d', 'g_d.gig_id', '=', 'gigs.id')
                    ->join('gig_stats as g_s', 'g_s.gig_id', '=', 'gigs.id')
                    ->join('gig_images as g_i', function ($join) {
                        $join->on('g_i.gig_id', '=', 'gigs.id')
                            ->where('g_i.image_type', 'M');
                    })
                    ->join('orders', 'orders.gig_id', '=', 'gigs.id')
                    ->join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
                    ->select('gigs.id', 'g_d.title', 'g_d.description', 'g_s.order_count', 'g_i.image_path', 'g_d.slug')
                    ->selectRaw("SUM(case when orders.status = '".OrderStatus::Completed->value."' then o_d.amount else 0.00 end) as revenue") // , SUM(o_d.amount) as revenue
                    ->selectRaw("SUM(orders.status = '".OrderStatus::Cancelled->value."') as refund, ROUND(SUM(orders.status = '".OrderStatus::Completed->value."')/COUNT(orders.id)*100) as percent")
                    ->where('gigs.is_approved', 1)
                    ->where('gigs.is_active', true)
                    ->groupBy('orders.gig_id','gigs.id', 'g_d.title','g_d.description','g_s.order_count', 'g_i.image_path','g_d.slug')
                    ->orderBy('g_s.order_count', 'DESC')
                    ->take(5)
                    ->get();
        return view('livewire.admin.dashboard.top-gigs', ['gigs' => $gigs]);
    }
}
