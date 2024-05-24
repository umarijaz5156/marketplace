<?php

namespace App\Http\Livewire\Affiliate;

use App\Models\AffiliateUsers;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $active = 0;
    public $banUserModal = false;
    public $banUserId;
    public function render()
    {
        $users =  AffiliateUsers::join('common_database.users', 'users.id', 'affiliate_users.user_id')
        ->where('affiliate_id', auth()->user()->id)
        ->where('verified', true)
        ->select('name', 'email', 'affiliate_users.created_at', 'affiliate_users.commission', 'affiliate_users.status')
        ->selectRaw('count(affiliate_users.commission)')
        ->groupBy('name','email', 'affiliate_users.created_at', 'affiliate_users.commission', 'affiliate_users.status')
        ->latest()->paginate(10);

        return view('livewire.affiliate.index', ['users' => $users]);
    }



}
