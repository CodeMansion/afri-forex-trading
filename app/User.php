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
        return $this->belongsTo('App\UserProfile','user_id');
    }

    public function UserDownline(){
        return $this->hasMany('App\UserDownline','user_id');
    }

    public function UserWallet(){
        return $this->belongsTo('App\UserWallet','user_id');
    }
}
