var AppUtilities = function() {

    var loadComponent = function() {
        $("#header_notification_bar").hide();
    }

    var displayNotifications = function() {
        $.ajax({
            url: NOTIFY, 
            success: function(data) {
                if(NOTIFY_COUNT >= 1) {
                    $('#notifyAudio')[0].play();
                }
                $('#header_notification_bar').show();
                $('#header_notification_bar').html(data);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                alert(errorMsg);
            }
        });
    }

    var markNotificationAsRead = function() {
        $.get('/markAsRead');
        location.reload();
    }

    setInterval(() => {
        displayNotifications();
    }, 10000)
    
    
    return {
        init: function() {
            loadComponent();

            displayNotifications();
        }
    }
}();

jQuery(document).ready(function() {
    AppUtilities.init();
});