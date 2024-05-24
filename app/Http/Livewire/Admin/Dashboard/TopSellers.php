<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Seller\Seller;
use Livewire\Component;

class TopSellers extends Component
{
    public function render()
    {
        $sellers = Seller::join('seller_stats as s_s', 's_s.seller_id', '=', 'sellers.id')
                        ->join('common_database.users', 'users.id', '=', 'sellers.user_id')
                        ->select('sellers.seller_name', 'sellers.joined_on', 'users.profile_photo_path')
                        ->where('sellers.is_approved', 1)
                        ->orderBy('s_s.total_orders', 'DESC')
                        ->take(5)
                        ->get();

        return view('livewire.admin.dashboard.top-sellers', ['sellers' => $sellers]);
    }
}
