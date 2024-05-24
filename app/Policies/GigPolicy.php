<?php

namespace App\Policies;

use App\Models\Seller\Gig;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GigPolicy
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

    public function view(?User $user, $gig){

        return $gig->is_approved && $gig->is_active ?  true : false;
     }
}
