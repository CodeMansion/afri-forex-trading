var AppUserProfile = function() {

    $("#user_details_for_fund").hide();
    $("#share_fund_btn").hide();
    var ChangePassword = function(password, new_password) {
        $("#change_password_btn").attr("disabled", true);
        $("#change_password_btn").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
        $.ajax({
            url: RESET,
            method: "POST",
            data: {
                '_token': TOKEN,
                'old_password': password,
                'password': new_password
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#change_password_btn").attr("disabled", false);
                    $("#change_password_btn").html(
                        "<i class='fa fa-check'></i> Submit!"
                    );
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#change_password_btn").attr("disabled", false);
                    $("#change_password_btn").html(
                        "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                    );
                    toastr.warning(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                toastr.error(errorMsg);
            }
        });
    };

    var UpdateProfile = function(full_name, telephone) {
        $("#update_profile_btn").attr("disabled", true);
        $("#update_profile_btn").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
        $.ajax({
            url: UPDATE,
            method: "POST",
            data: {
                '_token': TOKEN,
                'full_name': full_name,
                'telephone': telephone
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#update_profile_btn").attr("disabled", false);
                    $("#update_profile_btn").html(
                        "<i class='fa fa-check'></i> Submit!"
                    );
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#update_profile_btn").attr("disabled", false);
                    $("#update_profile_btn").html(
                        "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                    );
                    toastr.warning(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                toastr.error(errorMsg);
            }
        });
    };

    var SHAREFUND = function(user_id, amount) {
        $("#share_fund_btn").attr("disabled", true);
        $("#share_fund_btn").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
        $.ajax({
            url: SHARE_FUND,
            method: "POST",
            data: {
                '_token': TOKEN,
                'user_id': user_id,
                'amount': amount
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#share_fund_btn").attr("disabled", false);
                    $("#share_fund_btn").html("<i class='fa fa-check'></i> Submit!");
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#share_fund_btn").attr("disabled", false);
                    $("#share_fund_btn").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                    toastr.warning(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                toastr.error(errorMsg);
            }
        });
    };

    var GETUSERTRANSFERDETAIL = function(detail) {
        $("#get_detail_btn").attr("disabled", true);
        $("#get_detail_btn").html("<i class='fa fa-refresh fa-spin'></i> Processing...");
        $.ajax({
            url: USERDETAILS,
            method: "POST",
            data: {
                '_token': TOKEN,
                'detail': detail
            },
            success: function(rst) {
                $("#get_detail_btn").attr("disabled", false);
                $("#get_detail_btn").html("<i class='fa fa-check'></i> Continue!");
                $("#get_detail_btn").hide();
                $(".username_detail_filed").fadeOut();
                $("#user_details_for_fund").fadeIn();
                $("#user_details_for_fund").html(rst);
                $("#share_fund_btn").show();
            },
            error: function(alaxB, HTTerror, errorMsg) {
                toastr.error(errorMsg);
            }
        });
    };

    var ChangePicture = function() {

    }

    var UpdateAccountInfo = function() {

    }

    var ActivateAccount = function() {
        $.ajax({
            url: ACTIVATE,
            method: "POST",
            data: {
                'member_id': SLUG,
                '_token': TOKEN
            },
            success: function(rst) {
                swal("Successful!", rst.msg, "success");
                setTimeout(() => {
                    location.reload();
                }, 3000);
            },
            error: function(err, httpErr, ErrMsg) {
                swal("Error", ErrMsg, "error");
            }
        });
    }

    return {
        init: function() {
            $("#update_profile_btn").on("click", function() {
                var full_name = $("#full_name").val();
                var telephone = $("#telephone").val();
                if (full_name.length < 1) {
                    toastr.warning("Please Fullname can not be empty!");
                } else if (telephone.length < 1) {
                    toastr.warning("Please telephone number can not be empty!");
                } else {
                    UpdateProfile(full_name, telephone);
                }
            });
            $("#get_detail_btn").on("click", function() {
                var detail = $("#detail_field").val();
                if (detail.length < 1) {
                    toastr.warning("Please this text field can not be  empty!");
                } else {
                    GETUSERTRANSFERDETAIL(detail);
                }
            });

            $("#share_fund_btn").on("click", function() {
                var user_id = $("#receiver_user_id").val();
                var amount = $("#amount_to_transfer").val();
                if (user_id.length < 1) {
                    toastr.warning("Please this text field can not be  empty!");
                } else if (amount.length < 1) {
                    toastr.warning("Please this text field can not be  empty!");
                } else {
                    SHAREFUND(user_id, amount);
                }
            });

            $("#cancel_user_details").on("click", function() {
                $(".username_detail_filed").fadeIn();
                $("#detail_field").val("");
                $("#get_detail_btn").show();
                $("#share_fund_btn").hide();
                $("#user_details_for_fund").html("");
                $("#user_details_for_fund").hide();

            });

            $("#update_account_btn").on("click", function() {
                toastr.error("Sorry cannot perform this task at this time. Thank you!");
            });

            $("#change_picture_btn").on("click", function() {
                toastr.error("Sorry cannot perform this task at this time. Thank you!");
            });

            $("#change_password_btn").on("click", function() {
                //toastr.error("Sorry cannot perform this task at this time. Thank you!");
                var password = $("#password").val();
                var new_password = $("#new_password").val();
                var confirm_new_password = $("#confirm_new_password").val();
                if (password.length < 1) {
                    $("#errors").html("<div class='alert alert-danger'>Please password can not be empty</div><br/>");
                } else if (new_password.length < 1) {
                    $("#errors").html("<div class='alert alert-danger'>Please new password can not be empty</div><br/>");
                } else if (new_password != confirm_new_password) {
                    $("#errors").html("<div class='alert alert-danger'>Password and Confirm password do not match</div><br/>");
                } else {
                    ChangePassword(password, new_password);
                }
            });

            $("#activate_account").on("click", function() {
                swal({
                        title: "Are you sure?",
                        text: "You are about to activate a new member account",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, activate!",
                        closeOnConfirm: false
                    },
                    function() {
                        ActivateAccount();
                    });
            });
        }
    }
}();

jQuery(document).ready(function() {
    AppUserProfile.init();
});