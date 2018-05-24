const Withdrawal = function() {

	const LoadComponents = function() {
		$("#withdrawal_div_loader").hide();
	};

	const DisplayWithdrawal = function(withdrawal_id) {
		$("#withdrawal_details").hide();
        $("#withdrawal_div_loader").show();
        $("#view-withdrawal").modal();
        
    	// $.ajax({
     //        url: view_withdrawal,
     //        method: "POST",
     //        data: {
     //        	'withdrawal_id': id,
     //        	'_token': TOKEN
     //        },
     //        success: function(rst){
     //            $("#loading_div").hide();
     //            $("#assessment_details_div").fadeIn();
     //            $("#assessment_details_div").html(rst);
     //        },
     //        error: function(jqXHR, textStatus, errorMessage){
     //            $("#edit-assessment").modal('hide');
     //            swal("An Error Occur!", errorMessage, "error");
     //        }
     //    });
	};

	return {
		init: function() {
			$(".table.table-bordered.table-hover.withdrawal tbody tr").each(function(index) {
				$("#edit_withdrawal_" + index).on("click", function() {
					let withdrawal_id = $("#withdrawal_id_" + index).val();
					DisplayWithdrawal(withdrawal_id);
				});
			});
		}
	}

}();

jQuery(document).ready(function() {
	Withdrawal.init();
});