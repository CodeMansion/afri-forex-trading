<?php

namespace App\Providers;

use App\Permission;

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

        //If the permission table exist in the database
        // if(Schema::hasTable('permissions')){
        //     foreach($this->getPermissions() as $permission){
        //         $gate->define($permission->name, function($user) use ($permission){
        //             return $user->hasRole($permission->roles);
        //         });
        //     }
        // }
    }

    protected function getPermissions(){
        return Permission::with('roles')->get(); 
    }
}
