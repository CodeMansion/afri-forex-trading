<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    protected $fillable = ['title', 'message', 'dispute_priority_id']; 

    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function scopeUserDispute($query) {
        return $query->where('user_id',\Auth::user()->id);
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function setTitleAttribute($value) {
        return $this->attributes['title'] = strtoupper($value);
    }

    public function priority() {
        return $this->belongsTo('App\DisputePriority', 'dispute_priority_id');
    }

    public function reply() {
        return $this->hasMany('App\DisputeReply', 'dispute_id');
    }

    public function scopeIsResponded($query) {
        return $query->where('status',1)->count();
    }

    public function scopeIsPending($query) {
        return $query->where('status',0)->count();
    }

    public function scopeIsResolved($query) {
        return $query->where('status',2)->count();
    }
}