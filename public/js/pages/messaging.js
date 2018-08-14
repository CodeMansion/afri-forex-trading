var AppMessaging = function() {

    var loadContents = function() {
        jQuery("#message_compose").show();
        jQuery("#message_draft").hide();
        jQuery("#message_sent").hide();
        jQuery("#message_trash").hide();
        jQuery("#loader").hide();
        jQuery("#show_individuals").hide();
    }

    var recipientType = function(type) {
        if(type == 'individuals') {
            $("#show_individuals").show();
        }
    }

    var showSentItems = function() {
        $("#message_compose").hide();
        $("#message_draft").hide();
        $("#message_sent").fadeIn();
        $("#message_trash").hide();
    };

    var showCompose = function() {
        $("#message_compose").fadeIn();
        $("#message_draft").hide();
        $("#message_sent").hide();
        $("#message_trash").hide();
    };

    var showTrashedMessages = function() {
        $("message_trash").fadeIn();
        $("#message_compose").hide();
        $("#message_draft").hide();
        $("#message_sent").hide();
    };

    var showDrafts = function() {
        $("#message_compose").hide();
        $("#message_draft").fadeIn();
        $("#message_sent").hide();
        $("#message_trash").hide();
    };

    var showCc = function() {
        $("#show_bcc").hide();
        $("#show_cc").fadeIn();
    };

    var showBcc = function() {
        $("#show_cc").hide();
        $("#show_bcc").fadeIn();
    };

    var sendMail = function() {
        var type = $("#type").val();
        var receiver;
        (type == 'individuals') ? receiver = $("#to").val() : reciever = false;
        
        var subject = $("#subject").val();
        var message = tinymce.activeEditor.getContent();

        if(type.length < 1) {
            App.scrollTop($("#errorMsg"));
            $("#errorMsg").html("<div class='alert alert-danger'>Please select recipient type</div>");
        } else if(type == "individuals" && receiver.length < 1) {
            App.scrollTop($("#errorMsg"));
            $("#errorMsg").html("<div class='alert alert-danger'>Please at least one email address</div>");
        } else if(subject.length < 1) {
            App.scrollTop($("#errorMsg"));
            $("#errorMsg").html("<div class='alert alert-danger'>Please provide a subject</div>");
        } else {

            $("#send_message").attr('disabled',true);
            $("#loader").show();

            $.ajax({
                url: SEND,
                method: "POST",
                data:{
                    '_token': TOKEN,
                    'to' : receiver,
                    'subject' : subject,
                    'message' : message,
                    'type': type,
                    'req' : "send-mail"
                },
                success: function(rst){
                    if(rst.type == "true") {
                        $("#send_message").attr('disabled',false);
                        $("#loader").hide();
                        if(swal('Message Sent Successfully', rst.msg, 'success')) {
                            location.reload();
                        }
                    } else if(rst.type) {
                        $("#send_message").attr('disabled',false);
                        $("#loader").hide();
                        swal(rst.head, rst.msg, 'error');
                    }
                },
                error: function(rst, httpErr, errorMessage){
                    $("#send_message").attr('disabled',false);
                    $("#loader").hide();
                    swal('Please try again', errorMessage, 'warning');
                }
            });
        }
    }

    return {
        init: function() {
            
            loadContents();

            $("#type").on("change", function() {
                $("#show_individuals").hide();
                recipientType($(this).val());
            });

            $("#send_message").on("click", function() {
                $("#errorMsg").html("");
                sendMail();
            });

            $("#btn_sent").on("click", function() {
                showSentItems();
            });

            $("#btn_compose").on("click", function() {
                showCompose();
            });

            $("#btn_trash").on("click", function() {
                showTrashedMessages();
            });

            $("#btn_draft").on("click", function() {
                showDrafts();
            });

            $("#message_parent .close").on("click",function() {
                $(this).parent().hide();
            });
        }
    }
}();

jQuery(document).ready(function() {
    AppMessaging.init();
});