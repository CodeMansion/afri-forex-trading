<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDownline extends Model
{
    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Profile(){
        return $this->hasOne('App\UserProfile','user_id');
    }
}
