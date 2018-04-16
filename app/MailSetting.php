<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    protected $fillable = ['host', 'username', 'password', 'encryption', 'port', 'from_name', 'from_email', 'reply_to'];

    public function setFromEmailAttribute($value) {
        return $this->attributes['from_email'] = preg_replace('/\s/', '', strtolower($value));
    }

    public function setReplyToAttribute($value) {
        return $this->attributes['reply_to'] = preg_replace('/\s/', '', strtolower($value));
    }

    public function setHostAttribute($value) {
        return $this->attributes['host'] = strtolower($value);
    }

    public function setUsernameAttribute($value) {
        return $this->attributes['username'] = preg_replace('/\s/', '', $value);
    }
}
