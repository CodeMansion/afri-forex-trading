<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = ['application_name', 'motto', 'description', 'default_currency', 'currency_exchange_api'];

    public function setApplicationNameAttribute($value) {
        return $this->attributes['application_name'] = ucwords($value);
    }

    public function setMottoAttribute($value) {
        return $this->attributes['motto'] = ucwords($value);
    }

    public function setDescriptionAttribute($value) {
        return $this->attributes['description'] = ucfirst($value);
    }
}
