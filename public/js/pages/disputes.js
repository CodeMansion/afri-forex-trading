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

    return {
        init: function() {
            loadComponents();

            $("#create_new_dispute_btn").on("click", function() {
                CreateDispute();
            });

            $('body').find("table.table-striped.table-bordered.table-hover.disputes_list tbody tr").each(function(index) {
                $("#manage_dispute_" + index).on("click", function() {
                    getDisputeDetails(index);
                });
            });
        }
    }
}();

jQuery(document).ready(function() {
    AppDisputes.init();
});