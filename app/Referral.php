<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
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

	public function scopeUserReferrals($query){
		return $query->where('user_id',auth()->user()->id);
	}
}
