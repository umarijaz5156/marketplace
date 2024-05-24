<?php

namespace App\Http\Livewire\Seller;

use App\Models\User;
use Livewire\Component;
use App\Events\UserStatus;
use App\Events\UserOffline;
use Illuminate\Support\Facades\Auth;

class SellerNavigation extends Component
{
    public $seller_info;
    public $status;

    public function getListeners()
    {
        if(auth()->check()){

            return [

                // "echo-presence:chat-status,here" => 'showOnline',
                // "echo-presence:chat-status,joining" => 'showOnline',
                // "echo-presence:chat-status,leaving" => 'hideOffline',

            ];
        }

    }

    public function showOnline(User $user)
    {

        $user->is_online = true;
        $user->save();

        broadcast(new UserStatus($user))->toOthers();
    }

    public function hideOffline(User $user)
    {

        $user->is_online = false;
        $user->save();

        broadcast(new UserOffline($user))->toOthers();
    }

    public function mount()
    {

        $user = Auth::user();
        $this->seller_info = $user->seller;
        $this->status =  $user->seller->is_approved;

    }
    public function render()
    {
        return view('livewire.seller.seller-navigation');
    }
}
