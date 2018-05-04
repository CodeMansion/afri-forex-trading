//adding new store
$("#add-packagetype").on("click", function() {
    var name = $("#name").val();
    var percentage = $("#percentage").val();
    if (name.length < 1) {
        $("#serverError").html(
            "<div class='danger-alert'>Please enter a value for NAME</div><br/>"
        );
    } else if (percentage.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter a value for percentage</div><br/>");
    } else {
        $("#serverError").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Adding New Package Type...");

        //processing the new expense
        $.ajax({
            url: ADDPLATFORM,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'percentage': percentage,
                'req': "add_packagetype"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#add-packagetype").attr("disabled", false);
                    $("#add-packagetype").html("<i class='fa fa-check'></i> Add Package Type");
                    $("#serverError").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#add-packagetype").attr("disabled", false);
                    $("#add-packagetype").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverError").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#add-packagetype").attr("disabled", false);
                $("#add-packagetype").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverError").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    }
});

//$("#modal .modal").each(function(index) {
$('body').find("#packagetype_details").on("click ", "#edit-packagetype", function() {
    var slug = $("#slug").val();
    var name = $("#name1").val();
    var percentage = $("#percentage1").val();
    if (name.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter a value for NAME</div><br/>");
    } else if (percentage.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter a value for percentage</div><br/>");
    } else {
        $("#serverErrors1").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-spinner fa-spin'></i> Editing Package Type... please wait.");

        $.ajax({
            url: UPDATE_URL,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'percentage': percentage,
                'packagetype_id': slug,
                'req': "update_packagetype"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#edit-packagetype").attr("disabled", false);
                    $("#edit-packagetype").html("<i class='fa fa-check'></i> Edit Package Type");
                    $("#serverErrors1").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#edit-packagetype").attr("disabled", false);
                    $("#edit-packagetype").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors1").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#edit-packagetype").attr("disabled", false);
                $("#edit-packagetype").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors1").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    }
});
//});

$('body').find("table.table-striped.table-hover.package_type tbody tr").each(function(index) {
    $("#edit" + index).on("click", function() {
        $("#edit_package_type").modal();
        $("#loading").show();
        $("#packagetype_details").hide();
        var package_type_id = $("#package_type_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "POST",
            data: {
                '_token': TOKEN,
                'packagetype_id': package_type_id,
            },
            success: function(rst) {
                $("#loading").hide();
                $("#packagetype_details").fadeIn();
                $("#packagetype_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#packagetype_details").hide();
                $("#serverErrors1").show();
                $("#serverErrors1").html("<div class='danger-alert'>" + errorMessage + "</div>");
            }
        });
    });
});

$('body').find("table.table-striped.table-hover.packagetype tbody tr").each(function(index) {
    $("#btn_package_type_delete" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Deleting this Package Type...");

        //deleting package type
        $.ajax({
            url: $(this).data("href"),
            method: "GET",
            data: {
                '_token': TOKEN,
                'req': "packagetype_delete"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_package_type_delete").attr("disabled", false);
                    $("#btn_package_type_delete").html("<i class='fa fa-check'></i> deleted.");
                    $("#serverErrors").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_package_type_delete").attr("disabled", false);
                    $("#btn_package_type_delete").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#btn_package_type_delete").attr("disabled", false);
                $("#btn_package_type_delete").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    });
});