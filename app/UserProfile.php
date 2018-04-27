<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['full_name', 'country_id', 'telephone', 'email'];

    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function setFullNameAttribute($value) {
        return $this->attributes['full_name'] = ucwords($value);
    }

    public function setEmailAttribute($value) {
        return $this->attributes['email'] = preg_replace('/\s/', '', strtolower($value));
    }

    public function User(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
