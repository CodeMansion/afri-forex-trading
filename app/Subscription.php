<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
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

    public function platform() {
        return $this->belongsTo('App\Platform', 'platform_id');
    }

    public function scopeUserSubscriptions($query){
        return $query->where('user_id',auth()->user()->id);
    }

    public function scopeSubscriptionMembers($query) {
        return $query->where([
            'status' => 1
        ]);
    }
}
