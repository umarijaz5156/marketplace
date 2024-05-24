<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order\Order;
use App\Models\Ticket\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }


    /**
     * user cannot order if he is banned
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return !$user->is_banned;
    }

    /**
     * check if ticket managaer can see order details
    */
    public function view(User $user, Order $order)
    {
        if(Ticket::where('ticket_manager_id', $user->id)->where('order_id', $order->id)->first()){
            return true;
        }

        return false;
    }

    public function userView(User $user, Order $order)
    {
        return $order->buyer->id == $user->id ? true : false;
    }

    public function sellerView(User $user, Order $order)
    {
        return $order->seller->user_id == $user->id;
    }
}
