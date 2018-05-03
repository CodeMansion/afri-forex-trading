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
}
