$('#register_user').on('click', function() {
    var upline = $("#upline_id").val();
    var fullname = $('#full_name').val();
    var username = $("#username").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var country_id = $("#country_id").val();
    var state_id = $("#state_id").val();
    var telephone = $("#telephone").val();
    var confirm_password = $("#confirm_password").val();
    if (fullname < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please Fullname can not be empty</div><br/>");
    } else if (email < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please email can not be empty</div><br/>");
    } else if (password < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please password can not be empty</div><br/>");
    } else if (username < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please username can not be empty</div><br/>");
    } else if (country_id < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please country can not be empty</div><br/>");
    } else if (state_id < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please state can not be empty</div><br/>");
    } else if (telephone < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please telephone can not be empty</div><br/>");
    } //else if (password != $("#confirm_password").val()) {
    //$("#errors").html("<div class='alert alert-danger'>Password and Confirm password do not match</div><br/>");
    //} 
    else {
        $("#errors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Processing...");

        //register new user
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
                'password_confirmation': confirm_password,
                'country_id': country_id,
                'state_id': state_id,
                'telephone': telephone,
                'req': 'register_new_user'
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#register_user").attr("disabled", false);
                    $("#register_user").html(
                        "<i class='fa fa-check'></i> Submit!"
                    );
                    $("#errors").html(
                        "<div class='alert alert-success'>" +
                        rst.msg +
                        "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#register_user").attr("disabled", false);
                    $("#register_user").html(
                        "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                    );
                    $("#errors").html(
                        "<div class='alert alert-danger'>" +
                        rst.msg +
                        "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#register_user").attr("disabled", false);
                $("#register_user").html(
                    "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                );
                $("#errors").html(
                    "<div class='alert alert-danger'>" +
                    rst.msg +
                    "</div><br/>"
                );
            }
        });
    }
})