<?php

namespace App\Http\Livewire\Admin;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Revenue extends Component
{
    use WithPagination;

    public $filterStatus;

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
            ->join('gigs', 'gigs.id', '=', 'orders.gig_id')
            ->join('gig_details as g_d', 'g_d.gig_id', '=', 'gigs.id')
            ->selectRaw('
                            orders.id as id, orders.status ,orders.created_at,
                            o_d.amount, o_d.total, o_d.commission,
                            g_d.title as gig_title
                        ')
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->paginate(20);

        $financialTransactions = 0;
        $totalCommission = 0;
        $estimatedRevenue = 0;
        $refundedTransactions = 0;

        foreach (Order::all() as $order) {
            if ($order->status == OrderStatus::Completed->value) {
                $financialTransactions += $order->load('orderDetails')->orderDetails->amount;
                $totalCommission += $order->load('orderDetails')->orderDetails->commission;
                $estimatedRevenue += $order->load('orderDetails')->orderDetails->amount;
            }

            if ($order->status == OrderStatus::InProgress->value) {
                $estimatedRevenue += $order->load('orderDetails')->orderDetails->amount;
            }

            if ($order->status == OrderStatus::Delivered->value) {
                $estimatedRevenue += $order->load('orderDetails')->orderDetails->amount;
            }

            if ($order->status == OrderStatus::Disputed->value) {
                $estimatedRevenue += $order->load('orderDetails')->orderDetails->amount;
            }

            if ($order->status == OrderStatus::Cancelled->value) {
                $refundedTransactions += $order->load('orderDetails')->orderDetails->total;
                $totalCommission += $order->load('orderDetails')->orderDetails->commission;
            }

            // if ($order->status == OrderStatus::Refunded->value) {
            //     $refundedTransactions += $order->load('orderDetails')->orderDetails->total;
            //     $totalCommission += $order->load('orderDetails')->orderDetails->commission;
            // }
        }


        return view('livewire.admin.revenue', [
            'orders' => $orders,
            'financialTransactions' => number_format($financialTransactions, 2),
            'totalCommission' => number_format($totalCommission, 2),
            'estimatedRevenue' => number_format($estimatedRevenue, 2),
            'refundedTransactions' => number_format($refundedTransactions, 2)
        ])
            ->layout('components.admin-layout');
    }
}
