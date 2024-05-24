<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{

    public function redirect(Request $request)
    {
        if(!is_null($request->affiliate_key)){
             User::where('affiliate_link', $request->affiliate_key)->where('is_affiliate', true)->firstOrFail();
            return redirect(route('home', ['key' => $request->key]));
        }

    }
}
