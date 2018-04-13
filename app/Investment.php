<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function User(){
        return $this->belongsTo('App\User','user_id');
    }

    public function Package(){
        return $this->belongsTo('App\Package','package_id');
    }

    public function PackageType(){
        return $this->belongsTo('App\PackageType','package_type_id');
    }
}
