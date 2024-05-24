<?php

namespace App\Http\Responses;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

class LoginResponse implements ContractsLoginResponse
{


    public function toResponse($request)
    {


        // Check is logged in user is banned
        abort_if(Auth::user()->is_banned, 403, "Your account has been banned");
        User::where('id', Auth::user()->id)->update([
            'is_online' => true
        ]);
        
        if(session()->has('url.intended')){
            return redirect(session()->get('url.intended'));
        }
        $request->session()->regenerate();
        // redirect user to admin panel
        if (Auth::user()->is_admin) {

            return redirect('/admin/dashboard');
        }

      

      
        // redirect user if he is ticket manager
        if(Auth::user()->is_ticket_manager) {
            return redirect()->route('admin.ticket-management');
        }
        
        // redirect to normal home
        return redirect()->intended(config('fortify.home'));
        
    }
}