<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'username','country_id','state_id','upline_id','telephone','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }
    
    public function Profile(){
        return $this->hasOne('App\UserProfile','user_id');
    }

    public function isA($field) {
        $roles = \DB::table("role_user")->where([
            'user_id' => $this->id,
        ])->get();

        foreach($roles as $role) {
            $check = Role::find($role->role_id);
            if(isset($check) && $check->name == $field){
                return true;
            }
        }
        return false;
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role){
        if(is_string($role)){
            return $this->roles->contains('name', $role);
        }

        foreach($role as $r){
            if($this->hasRole($r->name)){
                return true;
            }
        }

        return false;
    }

    public function assignRole($id){
        $roleID = Role::where([
            'id' => $id,
        ])->firstOrFail();
        $insert = \DB::table("role_user")->insert([
            'user_id'   => $this->id,
            'role_id'   => $roleID->id,
        ]);

    }
    
    public function UserDownline($platform_id){
        if($platform_id == ''){
            return $this->hasMany('App\UserDownline','upline_id');
        }
        return $this->hasMany('App\UserDownline','upline_id')->where('platform_id',$platform_id);
    }

    public function Platform(){
        return $this->hasMany('App\Platform','platform_id');
    }   

    public function UserWallet(){
        return $this->belongsTo('App\UserWallet','user_id');
    }

    public function ActivityLog(){
        return $this->hasMany('App\ActivityLog','user_id');
    }

    
}
