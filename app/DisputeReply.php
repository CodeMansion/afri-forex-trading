<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisputeReply extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function dispute() {
        return $this->belongsTo('App\Dispute', 'dispute_id');
    }
}
