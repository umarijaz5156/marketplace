<?php

namespace App\Policies;

use App\Models\Seller\Gig;
use App\Models\Seller\Seller;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SellerPolicy
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
     * Determine if the given seller can create a gig
     * 
     *@param \App\Models\Seller\Seller
     *@return bool
     */
    public function create(User $user)
    {
        $seller = Seller::where('user_id', $user->id)->first();
        return $seller->is_approved
                    ? Response::allow()
                    : Response::deny('Your account is not verified');
    }

    /**
     * Determine if the given user can access seller dashboard
     * 
     * @param \App\Models\Seller\Seller
     * @return bool
     */

    public function view(User $user)
    {
        return $user->is_seller;
    }
}
