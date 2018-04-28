var AppUserProfile = function() {
    
    var loadComponents = function() {
        $("#loader").hide();
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

    var UpdateProfile = function() {

    }

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
                swal("Successful!",rst.msg,"success");
                setTimeout(() => {
                    location.reload();
                },3000);
            },
            error: function(err, httpErr, ErrMsg) {
                swal("Error",ErrMsg,"error");
            }
        });
    }

    return {
        init: function() {
            loadComponents();

            $("#update_profile_btn").on("click", function() {
                toastr.error("Sorry cannot perform this task at this time. Thank you!");
            });

            $("#update_account_btn").on("click", function() {
                toastr.error("Sorry cannot perform this task at this time. Thank you!");
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
                  function(){
                    ActivateAccount();
                  });
            });
        }
    }
}();

jQuery(document).ready(function(){
    AppUserProfile.init();
});