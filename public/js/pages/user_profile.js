var AppUserProfile = function() {
    
    var loadComponents = function() {
        $("#loader").hide();
        $("#user_details_for_fund").hide();
        $("#share_fund_btn").hide();
        $("#password_loader").hide();
        $("#password_div").show();
        $("#wallet_div").hide();
        $("#wallet_loader").hide();
        $("#account_loader").hide();
    } 

    var ChangePassword = function() {
        $("#errors").html("");
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        var confirm_password = $("#confirm_new_password").val();

        if(old_password.length < 1) {
            $("#errors").html("<div class='alert alert-danger'>Enter Old Password</div>");
        } else if(new_password.length < 1) {
            $("#errors").html("<div class='alert alert-danger'>Enter New Password</div>");
        } else if(confirm_password.length < 1) {
            $("#errors").html("<div class='alert alert-danger'>Confirm New Password</div>");
        } else if(confirm_password != new_password) {
            $("#errors").html("<div class='alert alert-danger'>Invalid password confirmation</div>");
        } else {
            $("#loader").show();
            $("#change_password_btn").attr('disabled',true);

            $.ajax({
                url: RESET_PASSWORD,
                method: "POST",
                data: {
                    'old_password': old_password,
                    'new_password': new_password,
                    'slug': USER_SLUG,
                    '_token': TOKEN
                },
                success: function(rst) {
                    if(rst.type == "true") {
                        $("#loader").hide();
                        $("#change_password_btn").attr('disabled',false);
                        toastr.success(rst.msg);
                        location.reload();
                    } else if(rst.type == "false") {
                        $("#loader").hide();
                        $("#change_password_btn").attr('disabled',false);
                        toastr.error(rst.msg);
                    }
                },
                error: function(err, httpErr, ErrMsg) {
                    toastr.error(ErrMsg);
                }
            });
        }
    }

    var UpdateProfile = function(full_name, telephone) {
        $("#update_profile_btn").attr("disabled", true);
        $("#update_profile_btn").html("<i class='fa fa-spinner fa-spin'></i> Processing...");
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
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#update_profile_btn").attr("disabled", false);
                    toastr.error(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                toastr.error(errorMsg);
            }
        });
    };

   

    var GETUSERTRANSFERDETAIL = function(detail) {
        $("#get_detail_btn").attr("disabled", true);
        $("#get_detail_btn").html("<i class='fa fa-spinner fa-spin'></i> Processing...");
        $.ajax({
            url: USERDETAILS,
            method: "POST",
            data: {
                '_token': TOKEN,
                'detail': detail
            },
            success: function(rst) {
                if(rst =="false"){
                    toastr.error("this user "+detail+" does not exist");
                    $("#get_detail_btn").attr("disabled", false);
                    $("#get_detail_btn").html("Continue");
                }else{
                    $("#get_detail_btn").attr("disabled", false);
                    $("#get_detail_btn").html("<i class='fa fa-check'></i> Continue");
                    $("#get_detail_btn").hide();
                    $(".username_detail_filed").fadeOut();
                    $("#user_details_for_fund").fadeIn();
                    $("#user_details_for_fund").html(rst);
                    $("#share_fund_btn").show();
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                toastr.error(errorMsg);
            }
        });
    };

    
    var UpdateAccountInfo = function() {
        $("#account_loader").show();
        $("#update_account_btn").attr('disabled', true);

        $.ajax({
            url: update_account_info,
            method: "POST",
            data: {
                'account_name': $("#account_name").val(),
                'account_number': $("#account_number").val(),
                'bank_name': $("#bank_name").val(),
                'swift_code': $("#swift_code").val(),
                'bank_code': $("#bank_code").val(),
                'sort_code': $("#sort_code").val(),
                'iban_number': $("#iban_number").val(),
                '_token': TOKEN
            },
            success: function(rst) {
                if(rst.type == "true") {
                    $("#account_loader").hide();
                    $("#update_account_btn").attr('disabled',false);
                    swal("Updated Successfully", rst.msg, "success");
                    location.reload();
                } else if(rst.type == "false") {
                    $("#account_loader").hide();
                    $("#update_account_btn").attr('disabled',false);
                    swal("Updated Failed", rst.msg, "error");
                }
            },
            error: function(err, httpErr, ErrMsg) {
                $("#account_loader").hide();
                $("#update_account_btn").attr('disabled',false);
                swal("Something Went Wrong", ErrMsg, "error");
            }
        });
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

    const ConfirmPassword = function(password) {
        $("#password_loader").show();
        $("#create_confirm_password").attr('disabled', true);

        $.ajax({
            url: confirm_password,
            method: "POST",
            data: {
                'password': password,
                '_token': TOKEN
            },
            success: function(rst) {
                if(rst.type == "true") {
                    $("#password_loader").hide();
                    $("#create_confirm_password").attr('disabled',false);
                    $("#password_div").hide();
                    $("#wallet_div").fadeIn();
                    toastr.success(rst.msg);
                } else if(rst.type == "false") {
                    $("#password_loader").hide();
                    $("#create_confirm_password").attr('disabled',false);
                    toastr.error(rst.msg);
                }
            },
            error: function(err, httpErr, ErrMsg) {
                toastr.error(ErrMsg);
            }
        });
    }


    const RefundWallet = function(amount,user_id) {
        $("#wallet_loader").show();
        $("#wallet_refund_btn").attr('disabled', true);

        $.ajax({
            url: refund_wallet,
            method: "POST",
            data: {
                'amount': amount,
                'user_id': user_id,
                '_token': TOKEN
            },
            success: function(rst) {
                if(rst.type == "true") {
                    $("#wallet_loader").hide();
                    $("#wallet_refund_btn").attr('disabled',false);
                    toastr.success(rst.msg);
                    location.reload();
                } else if(rst.type == "false") {
                    $("#wallet_loader").hide();
                    $("#wallet_refund_btn").attr('disabled',false);
                    toastr.error(rst.msg);
                }
            },
            error: function(err, httpErr, ErrMsg) {
                toastr.error(ErrMsg);
            }
        });
    }

    return {
        init: function() {
            loadComponents();

            $("#update_profile_btn").on("click", function() {
                var full_name = $("#full_name").val();
                var telephone = $("#telephone").val();
                if (full_name.length < 1) {
                    toastr.error("Please Fullname can not be empty!");
                } else if (telephone.length < 1) {
                    toastr.error("Please telephone number can not be empty!");
                } else {
                    UpdateProfile(full_name, telephone);
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

        
            $("#change_picture_btn").on("click", function() {
                toastr.error("Sorry cannot perform this task at this time. Thank you!");
            });

            $("#change_password_btn").on("click", function() {
                ChangePassword();
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


            $("#create_confirm_password").on("click", function() {
                let password = $("#password").val();
                if (password.length < 1) {
                    toastr.error("Please this text field can not be empty!");
                } else {
                    ConfirmPassword(password);
                }
            }); 
            
            $("#wallet_refund_btn").on("click", function() {
                let amount = parseFloat($("#amount").val());
                let user_id = $("#user_id").val();
                if (amount.length < 1) {
                    toastr.error("Please this text field can not be empty!");
                } else if(amount < 1) {
                    toastr.error("Invalid amount");
                } else {
                    RefundWallet(amount,user_id);
                }
            }); 


            $("#update_account_btn").on("click", function() {
                UpdateAccountInfo();
            });
        }
    }
}();

jQuery(document).ready(function() {
    AppUserProfile.init();
});