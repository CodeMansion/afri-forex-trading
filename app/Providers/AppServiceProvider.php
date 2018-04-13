<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Investment;
use App\Subscription;
use App\Referral;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if((isset(auth()->user()->id)) && (auth()->user()->is_admin == 0)){
            $subscription = Subscription::whereUserId(auth()->user()->id)->count();
            $investment = Investment::whereUserId(auth()->user()->id)->count();
            $referral   = Referral::whereUserId(auth()->user()->id)->count();
            if($subscription == 0 || $investment == 0 || $referral == 0){
                return redirect()->route('dashboard');
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
