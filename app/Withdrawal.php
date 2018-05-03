<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = ['amount', 'platform_id', 'user_id'];

    public function member() {
        return $this->belongsTo('App\User','user_id');
    }

    public function platform() {
        return $this->belongsTo('App\Platform', 'platform_id');
    }
}
