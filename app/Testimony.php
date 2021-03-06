<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $fillable = ['title', 'message'];
    
    public static function find($id, $field = null)
    {
        if ($field) {
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function scopeMemberTestimonies($query) {
        return $query->where('user_id', auth()->user()->id);
    }

    public function User() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function setTitleAttribute($query) {
        return $this->attributes['title'] = ucwords($query);
    }
}
