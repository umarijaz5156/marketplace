<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use Carbon\Carbon;
use Livewire\Component;

class SalesOverviewChart extends Component
{
    public array $dataThisYear = [];
    public array $dataPrevYear = [];
    public $salesIncOrDec;

    public function render()
    {
        $this->salesOverview();
        return view('livewire.admin.dashboard.sales-overview-chart');
    }

    public function salesOverview()
    {
        $query = Order::join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
                        ->selectRaw('year(orders.created_at) year, month(orders.created_at) month, SUM(o_d.amount) as total')
                        ->groupBy('year', 'month')
                        ->where('orders.status', OrderStatus::Completed->value);

        $clone_current_year = clone $query;
        $clone_prev_year = clone $query;

        // Sale this year
        $salesThisYear = $clone_current_year
                        ->whereYear('orders.created_at', Carbon::now())
                        ->get();


        $totalThis = 0;
        $this->dataThisYear = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach($salesThisYear as $sale) {
            $totalThis += $sale->total;
            $this->dataThisYear[$sale->month - 1] = $sale->total;
        }
        $this->dataThisYear = array_splice($this->dataThisYear, 0, Carbon::now()->month);

        // sales prev year
        $salesPrevYear = $clone_prev_year
                            ->whereYear('orders.created_at', Carbon::now()->subYear())
                            ->get();

        $totalPrev = 0;
        $this->dataPrevYear = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach($salesPrevYear as $sale_prev) {
            $totalPrev += $sale_prev->total;
            $this->dataPrevYear[$sale_prev->month - 1] = $sale_prev->total;
        }

        $this->salesIncOrDec = $totalPrev > 0 ? round((($totalThis - $totalPrev)/$totalPrev) * 100) : 100;
    }
}
