<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $fillable = ['account_name', 'account_number', 'bank_name', 'bank_code', 'swift_code', 'iban_number', 'sort_code'];

    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function setAccountNameAttribute($value) {
        return $this->attributes['account_name'] = ucwords(trim($value));
    }

    public function setAccountNumberAttribute($value) {
        return $this->attributes['account_number'] = trim($value);
    }

    public function setBankNameAttribute($value) {
        return $this->attributes['bank_name'] = ucwords($value);
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
