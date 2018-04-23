<?php

namespace App\Providers;

use App\Permission;
use App\Subscription;
use App\Investment;
use App\Referral;

use Illuminate\Support\Facades\Schema;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        $gate->define('is_account_active', function ($user){
            if(auth()->user()->is_admin == 0 && auth()->user()->is_active == 0)
                return true;
 
            return false;
         });

         $gate->define('has_member_paid', function($user) {
            if(auth()->user()->is_admin == 0 && auth()->user()->is_active == 1) {
                $subscription = Subscription::userSubscriptions()->count();
                $investment = Investment::userInvestments()->count();
                $referral   = Referral::userReferrals()->count();

                if($subscription < 1 || $investment < 1 || $referral < 1) 
                    return true;
                    
                return false;
            }
         });

        //If the permission table exist in the database
        if(Schema::hasTable('permissions')){
            foreach($this->getPermissions() as $permission){
                $gate->define($permission->name, function($user) use ($permission){
                    return $user->hasRole($permission->roles);
                });
            }
        }
    }

    protected function getPermissions(){
        return Permission::with('roles')->get(); 
    }
}
