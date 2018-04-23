var AppUserProfile = function() {
    
    var ChangePassword = function() {

    }

    var UpdateProfile = function() {

    }

    var ChangePicture = function() {

    }

    var UpdateAccountInfo = function() {

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
        }
    }
}();

jQuery(document).ready(function(){
    AppUserProfile.init();
});