//adding new store
$("#add-transactioncategories").on("click", function() {
    var name = $("#name").val();
    if (name.length < 1) {
        $("#serverError").html(
            "<div class='danger-alert'>Please enter a value for NAME</div><br/>"
        );
    } else {
        $("#serverError").html("");
        $(this).attr("disabled", true);
        $(this).html(
            "<i class='fa fa-refresh fa-spin'></i> Adding New Transaction Category..."
        );

        //processing the new expense
        $.ajax({
            url: ADD,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'req': "add_transactioncategories"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#add-transactioncategories").attr("disabled", false);
                    $("#add-transactioncategories").html("<i class='fa fa-check'></i> Add Transaction Category");
                    $("#serverError").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#add-transactioncategories").attr("disabled", false);
                    $("#add-transactioncategories").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverError").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#add-transactioncategories").attr("disabled", false);
                $("#add-transactioncategories").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverError").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    }
});

//$("#modal .modal").each(function(index) {
$('body').find("#transactioncategories_details").on("click ", "#edit-transactioncategories", function() {
    var slug = $("#slug").val();
    var name = $("#name1").val();
    if (name.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter a value for NAME</div><br/>");
    } else {
        $("#serverErrors1").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-spinner fa-spin'></i> Editing Transaction Category... please wait.");

        $.ajax({
            url: UPDATE_URL,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'transactioncategories_id': slug,
                'req': "update_transactioncategories"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#edit-transactioncategories").attr("disabled", false);
                    $("#edit-transactioncategories").html("<i class='fa fa-check'></i> Edit Package Type");
                    $("#serverErrors1").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#edit-transactioncategories").attr("disabled", false);
                    $("#edit-transactioncategories").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors1").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#edit-transactioncategories").attr("disabled", false);
                $("#edit-transactioncategories").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors1").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    }
});
//});

$('body').find("table.table-striped.table-hover.transactioncategories tbody tr").each(function(index) {
    $("#edit" + index).on("click", function() {
        $("#edit_transactioncategories").modal();
        $("#loading").show();
        $("#transactioncategories_details").hide();
        var transactioncategories_id = $("#transactioncategories_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "POST",
            data: {
                '_token': TOKEN,
                'transactioncategories_id': transactioncategories_id,
            },
            success: function(rst) {
                $("#loading").hide();
                $("#transactioncategories_details").fadeIn();
                $("#transactioncategories_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#transactioncategories_details").hide();
                $("#serverErrors1").show();
                $("#serverErrors1").html("<div class='danger-alert'>" + errorMessage + "</div>");
            }
        });
    });
});

$('body').find("table.table-striped.table-hover.transactioncategories tbody tr").each(function(index) {
    $("#btn_transactioncategories_delete" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Deleting this Transaction Category...");

        //deleting package type
        $.ajax({
            url: $(this).data("href"),
            method: "GET",
            data: {
                '_token': TOKEN,
                'req': "transactioncategories_delete"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_transactioncategories_delete").attr("disabled", false);
                    $("#btn_transactioncategories_delete").html("<i class='fa fa-check'></i> deleted.");
                    $("#serverErrors").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_transactioncategories_delete").attr("disabled", false);
                    $("#btn_transactioncategories_delete").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#btn_transactioncategories_delete").attr("disabled", false);
                $("#btn_transactioncategories_delete").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    });
});