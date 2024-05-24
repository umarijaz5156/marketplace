<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class AdminDashboard extends Controller
{
    /**
     * main page for admin dashbaord
    **/
    public function index()
    {

        $users = User::count();
        $sellers = User::where('is_seller', '1')->count();

        // Find revenue query
        $revenueQuery = Order::join('order_details as o_d', 'o_d.order_id', 'orders.id')->selectRaw('SUM(o_d.amount) as revenue')->where('status', OrderStatus::Completed->value);

        $totalRevenueQuery = clone $revenueQuery;
        $totalRevenueThisMonthQuery = clone $revenueQuery;

        // Total revenue
        $totalRevenue = $totalRevenueQuery->first();

        // revenue this month
        $totalRevenueThisMonth = $totalRevenueThisMonthQuery->whereMonth('orders.updated_at', Carbon::now())->first();

        // Total cancelled orders
        $cancelledOrders = Order::where('status', OrderStatus::Cancelled->value)->count();

        $totalRegisteredUsersPerMonth = User::selectRaw('month(created_at) as month')
        ->selectRaw('count(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->whereYear('created_at',date('Y'))
        ->pluck('count','month');

        return view('admin.admin-dashboard', compact('users','sellers', 'totalRevenue', 'totalRevenueThisMonth', 'cancelledOrders'));
    }
}
