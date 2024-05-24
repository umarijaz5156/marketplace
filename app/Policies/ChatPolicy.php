<?php

namespace App\Policies;

use App\Models\ChatCenter\Chat;
use App\Models\Order\Order;
use App\Models\Seller\Gig;
use App\Models\Seller\Seller;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
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
     * user cannot contact seller if he is banned
     *
     * @param User $user
     * @return bool
     */
    public function contact(User $user)
    {
        return !$user->is_banned;
    }


    public function create(User $user, Gig $gig)
    {
        $seller = Seller::where('user_id', $user->id)->first();
        return !$seller->id === $gig->seller_id;
    }

    /**
     * check if ticket manager can view chat
     */

    public function view(User $user,Chat $chat)
    {

        $tickets = Ticket::where('ticket_manager_id', $user->id)->get();

        foreach($tickets as $ticket){
            if($ticket->order_id == $chat->content_id){
                return true;
            }
        }
        return false;
    }

    // check if user can view chat
    public function userView(User $user, Chat $chat)
    {
        return $user->id == $chat->sender_id ? true : false;
    }

    public function sellerView(User $user, Chat $chat)
    {
        return $chat->receiver->id == $user->id;
    }




}
