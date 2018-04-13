<?php 

function activity_logs($user,$ip,$action) {
	if(isset($user) && isset($ip) && isset($action)) {
		$log = new App\ActivityLog();
		$log->user_id = $user;
		//$log->slug = bin2hex(random_bytes(64));
		$log->ip = $ip;
		$log->action = $action;
		$log->save();
	}
}