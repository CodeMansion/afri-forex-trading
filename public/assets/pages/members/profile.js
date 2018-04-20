$('#update').on('click', function() {
    var fullname = $('#full_name').val();
    var username = $("#username").val();
    var email = $("#email").val();
    var country_id = $("#country_id").val();
    var state_id = $("#state_id").val();
    var telephone = $("#telephone").val();
    if (fullname < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please Fullname can not be empty</div><br/>");
    } else if (email < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please email can not be empty</div><br/>");
    } else if (username < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please username can not be empty</div><br/>");
    } else if (country_id < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please country can not be empty</div><br/>");
    } else if (state_id < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please state can not be empty</div><br/>");
    } else if (telephone < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please telephone can not be empty</div><br/>");
    } else {
        $("#errors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Processing...");

        //register new user
        $.ajax({
            url: REGISTER_URL,
            method: "POST",
            data: {
                '_token': TOKEN,
                'full_name': fullname,
                'email': email,
                'username': username,
                'country_id': country_id,
                'state_id': state_id,
                'telephone': telephone,
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

$("#change_password").on("click", function() {
    var password = $("#password").val();
    var new_password = $("#new_password").val();
    var confirm_new_password = $("#confirm_new_password").val();
    if (password < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please password can not be empty</div><br/>");
    } else if (new_password < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please new password can not be empty</div><br/>");
    } else if (new_password != confirm_new_password) {
        $("#errors").html("<div class='alert alert-danger'>Password and Confirm password do not match</div><br/>");
    } else {
        $("#errors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Processing...");
        $.ajax({
            url: RESET,
            method: "POST",
            data: {
                '_token': TOKEN,
                'password': new_password
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#change_password").attr("disabled", false);
                    $("#change_password").html("<i class='fa fa-check'></i> Submit!");
                    $("#errors").html(
                        "<div class='alert alert-success'>" +
                        rst.msg +
                        "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#change_password").attr("disabled", false);
                    $("#change_password").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                    $("#errors").html(
                        "<div class='alert alert-danger'>" +
                        rst.msg +
                        "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#change_password").attr("disabled", false);
                $("#change_password").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#errors").html(
                    "<div class='alert alert-danger'>" +
                    rst.msg +
                    "</div><br/>"
                );
            }
        });
    }
});