<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentMessage extends Model
{
    public function setSubjectAttribute($value) {
        return $this->attributes['subject'] = ucwords($value);
    }
}
