var AppDisputes = function() {

    var loadComponents = function() {
        $("#loader").hide();
        $('body').find("#loading").hide();
    }
    
    var CreateDispute = function() {
        var subject = $("#title").val();
        var message = tinymce.activeEditor.getContent();
        var priority = $("#priority").val();

        $("#errors").html("");

        if(subject.length < 1) {
            App.scrollTop($("#errors"));
            $("#errors").html("<div class='alert alert-danger'>Please provide dispute title</div>");
        } else if(priority.length < 1) {
            App.scrollTop($("#errors"));
            $("#errors").html("<div class='alert alert-danger'>Please enter dispute message</div>");
        } else {

            $("#create_new_dispute_btn").attr('disabled',true);
            $("#loader").show();

            $.ajax({
                url: SEND,
                method: "POST",
                data:{
                    '_token': TOKEN,
                    'title' : subject,
                    'message' : message,
                    'priority_id': priority
                },
                success: function(rst){
                    if(rst.type == "true") {
                        App.scrollTop($("#errors"));
                        $("#create_new_dispute_btn").attr('disabled',false);
                        $("#loader").hide();
                        $("#errors").html("<div class='alert alert-success'>" + rst.msg + "</div>");
                        location.reload();
                    } else if(rst.type) {
                        App.scrollTop($("#errors"));
                        $("#create_new_dispute_btn").attr('disabled',false);
                        $("#loader").hide();
                        $("#errors").html("<div class='alert alert-danger'>" + rst.msg + "</div>");
                    }
                },
                error: function(rst, httpErr, errorMessage){
                    $("#create_new_dispute_btn").attr('disabled',false);
                    $("#loader").hide();
                    $("#errors").html("<div class='alert alert-danger'>" + errorMessage + "</div>");
                }
            });
        }
    }


    var ReplyDispute = function() {
        var dispute_id = $("#dispute_id").val();
        var message = tinymce.activeEditor.getContent();

        $("#loader").show();
        $("#reply_dispute_btn").attr('disabled',true);

        $.ajax({
            url: REPLY,
            method: "POST",
            data:{
                '_token': TOKEN,
                'dispute_id' : dispute_id,
                'message' : message,
            },
            success: function(rst){
                if(rst.type == "true") {
                    $("#reply_dispute_btn").attr('disabled',false);
                    $("#loader").hide();
                    swal("Successful!", rst.msg, "success");
                    location.reload();
                } else if(rst.type) {
                    $("reply_dispute_btn").attr('disabled',false);
                    $("#loader").hide();
                    swal("An Error Occur", rst.msg, "error");
                }
            },
            error: function(rst, httpErr, errorMessage){
                $("#reply_dispute_btn").attr('disabled',false);
                $("#loader").hide();
                swal("An Error Occured", errorMessage, "error");
            }
        });
    }

    var getDisputeDetails = function(index) {

        $("#disputeErrors").html("");
        $("#dispute_details").hide();
        $("#loading").show();
        $("#manage_disputes").modal();

        var dispute_id = $("#dispute_id_" + index).val();

        $.ajax({
            url: GET_DETAILS,
            method: "POST",
            data: {
                '_token': TOKEN,
                'dispute_id': dispute_id,
                'req': "get-department-info"
            },
            success: function(rst) {
                $("#loading").hide();
                $("#dispute_details").fadeIn();
                $("#dispute_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#dispute_details").hide();
                $("#disputeErrors").html("<div class='alert alert-danger'>" + errorMessage + "</div><br/>");
            }
        });
    }

    var ResolveDispute = function() {
        var dispute_id = $("#dispute_id").val();

        $.ajax({
            url: RESOLVE,
            method: "POST",
            data: {
                '_token': TOKEN,
                'dispute_id': dispute_id,
                'req': "resolve_dispute"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    swal("Successful!", rst.msg, "success");
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else if (rst.type == "false") {
                    swal("Error",rst.msg,"error");
                }
            },
            error: function(jqXHR, textStatus, errorMessage) {
                swal("Error",errorMessage,"error");
                $("#resolve_dispute_btn").attr('disabled', false);
            }
        });
    }

    return {
        init: function() {
            loadComponents();

            $("#create_new_dispute_btn").on("click", function() {
                CreateDispute();
            });

            $("#reply_dispute_btn").on("click", function() {
                ReplyDispute();
            });

            $('body').find("table.table-striped.table-bordered.table-hover.disputes_list tbody tr").each(function(index) {
                $("#manage_dispute_" + index).on("click", function() {
                    getDisputeDetails(index);
                });
            });

            $("#resolve_dispute_btn").on("click", function() {
                swal({
                    title: "Are you sure?",
                    text: "You are about to mark this dispute as resolved. Do want to proceed?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {
                    ResolveDispute();
                });
            });
        }
    }
}();

jQuery(document).ready(function() {
    AppDisputes.init();
});