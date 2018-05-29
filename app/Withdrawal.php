<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = ['amount', 'platform_id', 'user_id'];

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function platform() {
        return $this->belongsTo('App\Platform', 'platform_id');
    }

    public function scopeMemberWithdrawal($query) {
        return $query->where([
            'user_id'   => auth()->user()->id
        ])->orderBy('id','DESC');
    }
}
