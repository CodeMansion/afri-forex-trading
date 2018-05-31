<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Subscription;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'username', 'country_id', 'upline_id', 'telephone', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function find($id, $field = null){
        if($field){
            return self::where($field, '=', $id)->firstOrFail();
        }
        return self::where('id', '=', $id)->firstOrFail();
    }

    public function setPasswordAttribute($query) {
        return $this->attributes['password'] = bcrypt($query);
    }

    public function setFullNameAttribute($value) {
        return $this->attributes['full_name'] = ucwords($value);
    }

    public function setEmailAttribute($value) {
        return $this->attributes['email'] = preg_replace('/\s/', '', strtolower($value));
    }

    public function setUserNameAttribute($value) {
        return $this->attributes['username'] = preg_replace('/\s/', '', $value);
    }
    
    public function Profile(){
        return $this->hasOne('App\UserProfile','user_id');
    }

    public function isA($field) {
        $roles = \DB::table("role_user")->where([
            'user_id' => $this->id,
        ])->get();

        foreach($roles as $role) {
            $check = Role::find($role->role_id);
            if(isset($check) && $check->name == $field){
                return true;
            }
        }
        return false;
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role){
        if(is_string($role)){
            return $this->roles->contains('name', $role);
        }

        foreach($role as $r){
            if($this->hasRole($r->name)){
                return true;
            }
        }

        return false;
    }

    public function assignRole($id){
        $roleID = Role::where([
            'id' => $id,
        ])->firstOrFail();
        $insert = \DB::table("role_user")->insert([
            'user_id'   => $this->id,
            'role_id'   => $roleID->id,
        ]);
    }
    
    public function UserDownline($platform_id=null){
        if($platform_id == null){
            return $this->hasMany('App\UserDownline','upline_id');
        }
        return $this->hasMany('App\UserDownline','upline_id')->where([
            'platform_id'   => $platform_id,
            'is_active'     => true
        ]);
    }

    public function UserDownlines($platform_id=null){
        return $this->hasMany('App\UserDownline','upline_id')->where([
            'platform_id'   => $platform_id
        ]);
    }

    public function UserEarnings() {
        return $this->hasMany('App\Earning', 'user_id');
    }

    public function Platform(){
        return $this->belongsToMany('App\Platform','member_services','platform_id');
    }    

    public function UserWallet(){
        return $this->hasOne('App\UserWallet','user_id');
    }    

    public function debit_transactions() {
        return $this->hasMany('App\PaymentTransaction', 'user_id')->where('transaction_category_id',2);
    }

    public function ActivityLog(){
        return $this->hasMany('App\ActivityLog','user_id');
    }

    public function Testimony()
    {
        return $this->hasMany('App\Testimony', 'user_id');
    }

    public function scopeMembers($query) {
        return $query->where('is_admin',false);
    }

    public static function hasEmail($field) {
        $check = self::where('email',$field)->first();
        return ($check);
    }

    public static function hasUsername($field) {
        $check = self::where('username',$field)->first();
        return ($check);
    }    

    public function scopeUserProfile($query) {
        return $query->where('id',auth()->user()->id)->first();
    }

    public static function SubscriptionMembers() {
        $members = Subscription::where([
            'status'    => 1
        ])->where('created_at', '<=', Carbon::now()->subDays(28)->toDateTimeString()->get();
        
        return $members;
    }

    public function UserWithdrawals() {
        return $this->hasMany('App\Withdrawal', 'user_id');
    }

    public function UserTransactions() {
        return $this->hasMany('App\PaymentTransaction','user_id');
    }
}
