<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function permissions(){
    	return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo(Permission $permission){
    	return $this->permissions()->save($permission);
    }
}
