<?php

namespace App\Http\Livewire\Seller;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use App\Models\Seller\Seller;
use Carbon\Carbon;
use Livewire\Component;

class StatsGraph extends Component
{
    public $dataset= [];
    public $labels = ['Jan' , 'Feb' , 'Mar' , 'Apr' , 'May' , 'June' , 'July' , 'Aug' , 'Sept' , 'Oct' , 'Nov', 'Dec'];
    public $filters;
    public $year;
    public $currentYearOrders;
    public $stripeModal;

    protected $listeners = ['refresh' => 'refresh'];

    public function render()
    {
        $this->currentYearOrders = $this->getData();
        // $this->labels = $this->getLabels();

        return view('livewire.seller.stats-graph');
    }


    public function mount()
    {
        $this->filters = $this->getFilters();
        $this->year =  Carbon::now()->year;
        // if(!auth()->user()->seller->stripe_onboarded){
        //     $this->stripeModal = true;
        // } else{
        //     $this->stripeModal = false;
        // }

    }

    private function getFilters(){

        $filters = [];
        $seller = Seller::where('user_id', auth()->user()->id)->first('created_at');
        $sellerYear = $seller->created_at;
        $currentDate = Carbon::now();
        $diff = $currentDate->diffInYears($sellerYear);

        for($i=0;$i <= $diff; $i++){
            $filters[] = now()->subYears($i)->format('Y');
        }
        return $filters;
    }

    private function getLabels(){

        $labels = [];
        $currentDate = Carbon::now()->startOfYear();
        while ($currentDate->year == Carbon::now()->year) {
            $labels[] = $currentDate->format('F');
            $currentDate->subMonth();
        }

        return $labels;
    }

    private function getData(){

        $salesThisYear = Seller::
            join('orders', 'orders.seller_id', '=', 'sellers.id')
            ->join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
            ->selectRaw('year(orders.created_at) year, month(orders.created_at) month, SUM(o_d.amount) as total')
            ->groupBy('year', 'month')
            ->where('sellers.user_id', auth()->user()->id)
            ->where('orders.status', OrderStatus::Completed->value)
            ->whereYear('orders.created_at', Carbon::now())
            ->get();


        $totalThis = 0;
        $this->dataThisYear = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach($salesThisYear as $sale) {
            $totalThis += $sale->total;
            $this->dataThisYear[$sale->month - 1] = $sale->total;
        }
        $this->dataThisYear = array_splice($this->dataThisYear, 0, Carbon::now()->month);

        return $this->dataThisYear;
    }

    public function updatedYear()
    {
        $this->currentYearOrders = $this->getData();
        $dataset = [
            [
                'label' => "Sale",
                'tension' => 0.4,
                'borderWidth' => 0,
                'pointRadius' => 0,
                'borderColor' => '#5e72e4',
                'backgroundColor' => 'gradientStroke1',
                'borderWidth' => 3,
                'fill' =>  false,
                'data' => $this->currentYearOrders
            ]
            ];
        $labels =  ['Jan' , 'Feb' , 'Mar' , 'Apr' , 'May' , 'June' , 'July' , 'Aug' , 'Sept' , 'Oct' , 'Nov', 'Dec'];
        $this->emit('updateChart', [
            'datasets' => $dataset,
            'labels' => $labels
        ]);
    }

    public function toggleModal()
    {
        $this->stripeModal = !$this->stripeModal;
    }

}
