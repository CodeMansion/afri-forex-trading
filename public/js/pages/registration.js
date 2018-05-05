var AppRegistration = function() {
    
    var submitForm = function() {
        var upline = $("#upline_id").val();
        var fullname = $('#full_name').val();
        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var country_id = $("#country_id").val();
        var telephone = $("#telephone").val();

        if (fullname.length < 1) {
            toastr.error("Full Name field is required");
        } else if (email.length < 1) {
            toastr.error("Email address field is required");
        } else if (password.length < 1) {
            toastr.error("Password field is required");
        } else if (username.length < 1) {
            toastr.error("Username field is required");
        } else if (country_id.length < 1) {
            toastr.error("Please select your country");
        } else if (telephone.length < 1) {
            toastr.error("Telephone field is required");
        } else {

            $("#register_member_btn").attr("disabled", true);
            $("#register_member_btn").html("<i class='fa fa-spinner fa-spin'></i> Processing...");
    
            $.ajax({
                url: REGISTER_URL,
                method: "POST",
                data: {
                    '_token': TOKEN,
                    'upline_id': upline,
                    'full_name': fullname,
                    'email': email,
                    'username': username,
                    'password': password,
                    'country_id': country_id,
                    'telephone': telephone,
                    'req': 'register_new_user'
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        $("#register_member_btn").attr("disabled", false);
                        $("#register_member_btn").html("Submit");
                        toastr.success("Registration was successfully. A link has been sent to your email for confirmation. Thank you!");
                        setTimeout(() => {
                            window.location.replace("/login");
                        }, 3000);
                    } else if (rst.type == "false") {
                        $("#register_member_btn").attr("disabled", false);
                        $("#register_member_btn").html("Submit");
                        toastr.error(rst.msg);
                    }
                },
                error: function(rst, trowHTTP, errorRun) {
                    $("#register_member_btn").attr("disabled", false);
                    $("#register_member_btn").html("Submit");
                    toastr.error(errorRun);
                }
            });
        }
    }

    var showPassword = function() {
        $("#password").attr('type','text');
    }

    var lockPassword = function() {
        $("#password").attr('type','password');
    }

    return {
        init: function() {

            $("#register_member_btn").on("click", function() {
                submitForm();
            });

            $("#show_password").on("mousedown", function() {
                showPassword();
                toastr.warning("Tips! Don't expose your password to anyone else.");
            });

            $("#show_password").on("mouseup", function() {
                lockPassword();
            });
        }
    }
}();

jQuery(document).ready(function() {
    AppRegistration.init();
});