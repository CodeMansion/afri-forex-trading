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

function member_status($value,$type) {
	if($value == 0){
		if($type == 'name') {
			return 'Inactive';
		}

		if($type == 'class') {
			return 'warning';
		}
	}

	if($value == 1){
		if($type == 'name') {
			return 'Active';
		}

		if($type == 'class') {
			return 'success';
		}
	}
	
	if($value == 2){
		if($type == 'name') {
			return 'Banned';
		}

		if($type == 'class') {
			return 'danger';
		}
    }
}

function subscription_status($value,$type) {
	if($value == 0){
		if($type == 'name') {
			return 'Inactive';
		}

		if($type == 'class') {
			return 'warning';
		}
	}

	if($value == 1){
		if($type == 'name') {
			return 'Active';
		}

		if($type == 'class') {
			return 'success';
		}
	}

	if($value == 2){
		if($type == 'name') {
			return 'Expired';
		}

		if($type == 'class') {
			return 'danger';
		}
	}

	if($value == 3){
		if($type == 'name') {
			return 'Canceled';
		}

		if($type == 'class') {
			return 'danger';
		}
	}
}

function investment_status($value,$type) {
	if($value == 0){
		if($type == 'name') {
			return 'Inactive';
		}

		if($type == 'class') {
			return 'warning';
		}
	}
}

function referral_status($value,$type) {
	if($value == 0){
		if($type == 'name') {
			return 'Inactive';
		}

		if($type == 'class') {
			return 'warning';
		}
	}
}

function earnings_status($value,$type) {
	if($value == 0){
		if($type == 'name') {
			return 'Pending';
		}

		if($type == 'class') {
			return 'warning';
		}
	}

	if($value == 1){
		if($type == 'name') {
			return 'Completed';
		}

		if($type == 'class') {
			return 'success';
		}
	}

	if($value == 1){
		if($type == 'name') {
			return 'Rollback';
		}

		if($type == 'class') {
			return 'danger';
		}
	}
}


function testimony_status($value,$type) {
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
			return 'Aprroved';
		}

		if($type == 'class') {
			return 'success';
		}
	}
    
    if($value == 2){
		if($type == 'name') {
			return 'Decline';
		}

		if($type == 'class') {
			return 'danger';
		}
	}
	
}

function withdrawal_status($value,$type) {
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
			return 'Aprroved';
		}

		if($type == 'class') {
			return 'warning';
		}
	}

	if($value == 2){
		if($type == 'name') {
			return 'Completed';
		}

		if($type == 'class') {
			return 'success';
		}
	}
	
	if($value == 3){
		if($type == 'name') {
			return 'Rejected';
		}

		if($type == 'class') {
			return 'danger';
		}
	}
}