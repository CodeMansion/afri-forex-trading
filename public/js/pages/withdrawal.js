const Withdrawal = function() {

	const LoadComponents = function() {
        $("#withdrawal_div_loader").hide();
        
	}

	const DisplayWithdrawal = function(withdrawal_id) {
		$("#withdrawal_details").hide();
        $("#withdrawal_div_loader").show();
        $("#view-withdrawal").modal();
        
    	$.ajax({
            url: view_withdrawal,
            method: "POST",
            data: {
            	'withdrawal_id': withdrawal_id,
            	'_token': TOKEN
            },
            success: function(rst){
                $("#withdrawal_div_loader").hide();
                $("#withdrawal_details").fadeIn();
                $("#withdrawal_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage){
                $("#view-withdrawal").modal('hide');
                swal("An Error Occur!", errorMessage, "error");
            }
        });
    }
    
    const ApproveWithdrawal = function(withdrawal_id) {
        $.ajax({
            url: approve_withdrawal,
            method: "POST",
            data: {
            	'withdrawal_id': withdrawal_id,
            	'_token': TOKEN
            },
            success: function(rst){
                swal("Approval Succecssful", rst.msg, "success");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            },
            error: function(jqXHR, textStatus, errorMessage){
                swal("An Error Occur!",errorMessage, "error");
            }
        });
    }

    const DeclineWithdrawal = function(withdrawal_id) {
        $.ajax({
            url: decline_withdrawal,
            method: "POST",
            data: {
            	'withdrawal_id': withdrawal_id,
            	'_token': TOKEN
            },
            success: function(rst){
                swal("Declined Succecssful", rst.msg, "success");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            },
            error: function(jqXHR, textStatus, errorMessage){
                swal("An Error Occur!",errorMessage, "error");
            }
        });
    }


    const CompleteWithdrawal = function(withdrawal_id) {
        $.ajax({
            url: complete_withdrawal,
            method: "POST",
            data: {
                'withdrawal_id': withdrawal_id,
                '_token': TOKEN
            },
            success: function(rst){
                swal("Completed Succecssful", rst.msg, "success");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            },
            error: function(jqXHR, textStatus, errorMessage){
                swal("An Error Occur!",errorMessage, "error");
            }
        });
    }

	return {
		init: function() {
            LoadComponents();

			$(".table.table-bordered.table-hover.withdrawal tbody tr").each(function(index) {
				$("#edit_withdrawal_" + index).on("click", function() {
					let withdrawal_id = $("#withdrawal_id_" + index).val();
					DisplayWithdrawal(withdrawal_id);
				});
            });
            
            $(".table.table-bordered.table-hover.withdrawal tbody tr").each(function(index) {
				$("#approve_withdrawal_" + index).on("click", function() {
                    let withdrawal_id = $("#withdrawal_id_" + index).val();
                    swal({
                        title: "Are you sure?",
                        text: "You are about to approve a withdrawal request",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, function() {
                        ApproveWithdrawal(withdrawal_id);
                    });
				});
            });
            
            $(".table.table-bordered.table-hover.withdrawal tbody tr").each(function(index) {
				$("#decline_withdrawal_" + index).on("click", function() {
                    let withdrawal_id = $("#withdrawal_id_" + index).val();
                    swal({
                        title: "Are you sure?",
                        text: "You are about to decline a withdrawal request",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, function() {
                        DeclineWithdrawal(withdrawal_id);
                    });
				});
			});


            $(".table.table-bordered.table-hover.withdrawal tbody tr").each(function(index) {
                $("#complete_withdrawal_" + index).on("click", function() {
                    let withdrawal_id = $("#withdrawal_id_" + index).val();
                    swal({
                        title: "Are you sure?",
                        text: "You are about to mark this withdrawal request as completed",
                        type: "warning",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, function() {
                        CompleteWithdrawal(withdrawal_id);
                    });
                });
            });
		}
	}
}();

jQuery(document).ready(function() {
	Withdrawal.init();
});