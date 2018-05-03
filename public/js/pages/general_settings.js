var GeneralSettings = function() {

    var loadComponents = function() {
        $("#loader").hide();
    }

    var updateSettings = function() {
        
        var application_name = $("#application_name").val();
        var motto = $("#motto").val();
        var description = $("#description").val();
        var exchange_api = $("#exchange_api").val();
        var currency = $("#default_currency").val();
        var system_status_id = $("#system_status_id").val();
        var sound_notification;
        var push_notification;
        var session_timeout;
        var login_alert;
        var system_backup;

        ($("#sound_notification").is(':checked')) ? sound_notification = true : sound_notification = false;
        ($("#push_notification").is(':checked')) ? push_notification = true : push_notification = false;  
        ($("#session_timeout").is(':checked')) ? session_timeout = true : session_timeout = false;
        ($("#login_alert").is(':checked')) ? login_alert = true : login_alert = false;
        ($("#backup").is(':checked')) ? system_backup = true : system_backup = false;
        
        $("#update_general_settings_btn").attr('disabled', true);
        $("#loader").show();

        $.ajax({
            url: UPDATE,
            type: "post",
            cache: false,
            data: {
                '_token': TOKEN,
                'application_name': application_name,
                'motto': motto,
                'description': description,
                'exchange_api': exchange_api,
                'currency': currency,
                'sound_notification': sound_notification,
                'push_notification': push_notification,
                'session_timeout' : session_timeout,
                'login_alert': login_alert,
                'system_backup': system_backup,
                'system_status_id': system_status_id
            },
            success: function(rst) {
                if(rst.type == "true") {
                    $("#update_general_settings_btn").attr('disabled', false);
                    $("#loader").hide();
                    swal("Successful", rst.msg, "success");
                    location.reload();
                } else if(rst.type == "false") {
                    $("#update_general_settings_btn").attr('disabled', false);
                    $("#loader").hide();
                    swal("Something Went Wrong", rst.msg, "warning");
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#update_general_settings_btn").attr('disabled', false);
                $("#loader").hide();
                swal("Something Went Wrong", thrownError, "warning");
            }
        });
    }

    return {
        init: function() {
            
            $("#update_general_settings_btn").on("click", function() {
                updateSettings();
            });

            loadComponents();
        }
    }
}();

jQuery(document).ready(function() {
    GeneralSettings.init();
});