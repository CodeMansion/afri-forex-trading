var MailSettings = function() {

    var loadComponents = function() {
        $("#loader").hide();
    }

    var updateSettings = function() {
        
        var host = $("#mail_host").val();
        var username = $("#host_username").val();
        var password = $("#host_password").val();
        var port = $("#host_port").val();
        var encryption = $("#mail_encryption").val();
        var sender_name = $("#sender_name").val();
        var sender_email = $("#sender_email").val();
        var reply_to = $("#reply_to").val();

        $("#update_mail_settings_btn").attr('disabled', true);
        $("#loader").show();

        $.ajax({
            url: UPDATE,
            type: "post",
            cache: false,
            data: {
                '_token': TOKEN,
                'host': host,
                'username': username,
                'password': password,
                'port': port,
                'encryption': encryption,
                'sender_name': sender_name,
                'sender_email': sender_email,
                'reply_to': reply_to
            },
            success: function(rst) {
                if(rst.type == "true") {
                    $("#update_mail_settings_btn").attr('disabled', false);
                    $("#loader").hide();
                    swal("Successful", rst.msg, "success");
                } else if(rst.type == "false") {
                    $("#update_mail_settings_btn").attr('disabled', false);
                    $("#loader").hide();
                    swal("Please try again", rst.msg, "warning");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#update_mail_settings_btn").attr('disabled', false);
                $("#loader").hide();
                swal("Please try again", thrownError, "warning");
            }
        });
    }

    return {
        init: function() {
            
            $("#update_mail_settings_btn").on("click", function() {
                updateSettings();
            });

            loadComponents();
        }
    }
}();

jQuery(document).ready(function() {
    MailSettings.init();
});