<?php

function dispute_status($value,$type) {
	if($value == 0){
		if($type == 'name') {
			return 'Pending';
		}

		if($type == 'class') {
			return 'default';
		}
	}

	if($value == 1){
		if($type == 'name') {
			return 'Disputes';
		}

		if($type == 'class') {
			return 'warning';
		}
    }
    
    if($value == 2){
		if($type == 'name') {
			return 'Resolved';
		}

		if($type == 'class') {
			return 'success';
		}
	}

	if($value == 3){
		if($type == 'name') {
			return 'Declined';
		}

		if($type == 'class') {
			return 'danger';
		}
	}
}