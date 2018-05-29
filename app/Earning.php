<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    public function type() {
        return $this->belongsTo('App\EarningType','earning_type_id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function platform() {
        return $this->belongsTo('App\Platform', 'platform_id');
    }

    public function scopeSubscriptionEarnings($query) {
    	return $query->where([
    		'user_id'		=> auth()->user()->id,
    		'platform_id'	=> 1
    	])->orderBy('id','DESC');
    }

    public function scopeInvestmentEarnings($query) {
    	return $query->where([
    		'user_id'		=> auth()->user()->id,
    		'platform_id'	=> 2
    	])->orderBy('id','DESC');
    }
}
