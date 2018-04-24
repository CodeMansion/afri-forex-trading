<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function Category(){
        return $this->belongsTo('App\TransactionCategory', 'transaction_category_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function Platform(){
        return $this->belongsTo(Platform::class);
    }

    public function scopeUserTransactions($query) {
        return $query->where('user_id',auth()->user()->id);
    }

    public function scopeUserLatestDebit($query) {
        return $query->where([
            'user_id' => auth()->user()->id,
            'transaction_category_id' => 2
        ])->orderBy('id','DESC')->limit(1);
    }

    public function scopeUserLatestCredit($query) {
        return $query->where([
            'user_id' => auth()->user()->id,
            'transaction_category_id' => 1
        ])->orderBy('id','DESC')->limit(1);
    }
}
