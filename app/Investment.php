<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function User(){
        return $this->belongsTo('App\User','user_id');
    }

    public function Package(){
        return $this->belongsTo('App\Package','package_id');
    }

    public function PackageType(){
        return $this->belongsTo('App\PackageType','package_type_id');
    }

    public function platform() {
        return $this->belongsTo('App\Platform', 'platform_id');
    }

    public function scopeUserInvestments($query){
        return $query->where('user_id',auth()->user()->id);
    }

    public function scopeDailyInvestors($query) {
        return $query->where([
            'package_type_id'   => 1,
            'status'            => 1
        ]);
    }

    public function scopeWeeklyInvestors($query) {
        return $query->where([
            'package_type_id'   => 2,
            'status'            => 1
        ]);
    }

    public function scopeMonthlyInvestors($query) {
        return $query->where([
            'package_type_id'   => 3,
            'status'            => 1
        ]);
    }

    public function scopeQuarterlyInvestors($query) {
        return $query->where([
            'package_type_id'   => 4,
            'status'            => 1
        ]);
    }
}
