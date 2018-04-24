var AppUserProfile = function() {
    
    var ChangePassword = function() {

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
                toastr.error("Sorry cannot perform this task at this time. Thank you!");
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