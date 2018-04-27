var AppUtilities = function() {

    var loadComponent = function() {
        $("#header_notification_bar").hide();
    }

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    } 

    var displayNotifications = function(type) {
        $.ajax({
            url: NOTIFY, 
            success: function(data) {
                if(NOTIFY_COUNT >= 1) {
                    if(ENABLE_SOUND == 1) {
                        $('#notifyAudio')[0].play();
                    }
                }
                $('#header_notification_bar').show();
                $('#header_notification_bar').html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                console.log(errorMsg);
            }
        });
    }

    
    var pushNotification = function() {
        if(NOTIFY_COUNT >= 1) {
            toastr.info("You have unread notifications");
        }
    }

    var markNotificationAsRead = function() {
        $.get('/markAsRead');
        location.reload();
    }


    setInterval(() => {
        displayNotifications();
    }, 10000)


    if(ENABLE_PUSH == 1) {
        setInterval(() => {
            pushNotification();
        }, 30000);
    }
    
    
    return {
        init: function() {
            loadComponent();
            displayNotifications();

            if(ENABLE_PUSH == 1) {
                pushNotification();
            }

            $('body').find("#header_notification_bar li #mark_notification_as_read li").each(function(index) {
                $("#mark_" + index).on("click", function() {
                    alert('hello');
                });
            });
            
        }
    }
}();

jQuery(document).ready(function() {
    AppUtilities.init();
});