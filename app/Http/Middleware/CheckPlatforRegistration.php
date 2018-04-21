<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use App\Investment;
use App\Subscription;
use App\Referral;

class CheckPlatforRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if((isset(auth()->user()->id)) && (auth()->user()->is_admin == 0)) {
            
        //     $subscription = Subscription::whereUserId(auth()->user()->id)->count();
        //     $investment = Investment::whereUserId(auth()->user()->id)->count();
        //     $referral   = Referral::whereUserId(auth()->user()->id)->count();

        //     if($subscription > 0 || $investment > 0 || $referral > 0){
        //         return $next($request);
        //     } else {
        //         return redirect()->route('dashboard');
        //     }
        // }

        return $next($request);
    }
}
