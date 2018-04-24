<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function Package(){
        return $this->hasMany('App\Packages','platform_id');
    }

    public function scopeActive($query){
        return $query->where('is_active',true);
    }
}
