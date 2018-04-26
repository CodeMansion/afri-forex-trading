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
        return $this->belongsTo('App\User','downline_id');
    }    

    public function scopeUserDownline($query) {
        return $query->whereUplineId(auth()->user()->id);
    }

    public function platform() {
        return $this->belongsTo('App\Platform', 'platform_id');
    }
}
