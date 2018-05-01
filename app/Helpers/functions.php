<?php 

function menu_active($current,$id1,$id2=null){
	$active = ($id2) ? (($current[0]==$id1) && isset($current[1]) && ($current[1]==$id2)) : ($current[0]==$id1);
	return ($active) ? "start open active" : "";
}

function activity_logs($user,$ip,$action) {
	if(isset($user) && isset($ip) && isset($action)) {
		$log = new App\ActivityLog();
		$log->user_id = $user;
		$log->slug = bin2hex(random_bytes(64));
		$log->ip = $ip;
		$log->action = $action;
		$log->save();
	}
}

function word_counter($string,$count,$end) {
	return \Illuminate\Support\Str::words($string,$count,$end);
}

function CheckMemberWallet($field) {
	$check = App\UserWallet::whereUserId($field)->first();
	return ($check);
}
