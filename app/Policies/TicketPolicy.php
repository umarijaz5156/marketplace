<?php

namespace App\Policies;

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use function PHPUnit\Framework\returnSelf;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
    * Determine whether the Ticket Manager can view the model.
    *
    * @param  \App\Models\User  $user
    * @return \Illuminate\Auth\Access\Response|bool
    */
    public function view(User $user)
    {
        return !$user->is_ticket_manager;
    }

    // check if user can view dispute
    public function userView(User $user, Ticket $ticket)
    {
        return $ticket->buyer_id == $user->id ? true : false;
    }

    public function sellerView(User $user, Ticket $ticket)
    {

        return $ticket->seller_id == $user->id ? true : false;
    }
}
