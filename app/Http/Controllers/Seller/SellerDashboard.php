<?php

namespace App\Http\Controllers\Seller;

use App\Enums\OrderStatus;
use App\Models\Seller\Seller;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class SellerDashboard extends Controller
{

    // public $expectedIncome;
    /**
     * index page for dashboard
     */
    public function index()
    {

        $this->authorize('view', Seller::class);


        $query = Seller::join('seller_stats as s_s', 's_s.seller_id', '=', 'sellers.id')
                        ->join('orders', 'orders.seller_id', '=', 'sellers.id')
                        ->join('order_details as o_d', 'o_d.order_id', '=', 'orders.id')
                        ->selectRaw('SUM(o_d.total) as total')
                        ->groupBy('orders.seller_id')
                        ->where('sellers.user_id', auth()->user()->id);

        $queryForExpectedIncome = clone $query;
        $queryForCurrentMonthIncome = clone $query;
        $queryForTotalIncome = clone $query;

        // expected income
        $expectedIncome = $queryForExpectedIncome
                        ->where(function($query) {
                            $query->where('orders.status', OrderStatus::InProgress->value)
                            ->orWhere('orders.status', OrderStatus::Pending->value)
                            ->orWhere('orders.status', OrderStatus::Delivered->value)
                            ->orWhere('orders.status', OrderStatus::Disputed->value);
                        })
                        ->first();

        // current Month
        $currentMonthIncom = $queryForCurrentMonthIncome
                            ->where('orders.status' , '=', OrderStatus::Completed->value)
                            ->whereMonth('orders.updated_at', Carbon::now())
                            ->first();

        // total income and total orders completed
        $totalIncome = $queryForTotalIncome
                        ->selectRaw('COUNT(orders.id) as orders_completed')
                        ->where('orders.status' , '=', OrderStatus::Completed->value)
                        ->first();

        $user = User::find(auth()->user()->id);
        // $user->setConnection('mysql');
        $notifications = $user->seller->notifications()->paginate(5);
        $notifications->merge($user->notifications);
        $notifications->sortBy('created_at');
        return view('seller.dashboard', [
            'expectedIncome' => $expectedIncome,
            'currentMonthIncom' => $currentMonthIncom,
            'totalIncome' =>  $totalIncome,
            'notifications' => $notifications
        ]);
    }

    public function messages()
    {
        return view('livewire.message-center.main')->layout('components.seller.dashboard-layout');
    }
}
