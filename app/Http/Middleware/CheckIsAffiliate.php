<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckIsAffiliate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if($request->query('affiliate_key')){
            $isAfffiliate = User::where('affiliate_link', $request->query('affiliate_key'))->where('is_affiliate', true)->first();
            if($isAfffiliate){
                $response->withCookie(cookie()->forever('affiliate_key', $request->query('affiliate_key')));
            }
        }

        return $response;
    }
}
