//adding new store
$("#add-package").on("click", function() {
    var name = $("#name").val();
    var platform_id = $("#platform_id").val();
    var investment_amount = $("#investment_amount").val();
    var monthly_charge = $("#monthly_charge").val();
    if (name.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter a value for NAME</div><br/>");
    } else if (platform_id.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please select Plaform</div><br/>");
    } else if (investment_amount.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter Investment amount</div><br/>");
    } else if (monthly_charge.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter onvestment monthly charge</div><br/>");
    } else {
        $("#serverError").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Adding New Package...");

        //processing the new expense
        $.ajax({
            url: ADDPLATFORM,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'platform_id': platform_id,
                'investment_amount': investment_amount,
                'monthly_charge': monthly_charge,
                'req': "add_package"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#add-platform").attr("disabled", false);
                    $("#add-platform").html(
                        "<i class='fa fa-check'></i> Add Platform"
                    );
                    $("#serverError").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#add-platform").attr("disabled", false);
                    $("#add-platform").html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    $("#serverError").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#add-platform").attr("disabled", false);
                $("#add-platform").html(
                    "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                );
                $("#serverError").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    }
});

//$("#modal .modal").each(function(index) {
$('body').find("#package_details").on("click ", "#edit-package", function() {
    var name = $("#name1").val();
    var slug = $("#slug").val();
    var platform_id = $("#platform_id1").val();
    var investment_amount = $("#investment_amount1").val();
    var monthly_charge = $("#monthly_charge1").val();
    if (name.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter a value for NAME</div><br/>");
    } else if (platform_id.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please select Plaform</div><br/>");
    } else if (investment_amount.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter Investment amount</div><br/>");
    } else if (monthly_charge.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter onvestment monthly charge</div><br/>");
    } else {
        $("#serverErrors1").html("");
        $(this).attr('disabled', true);
        $(this).html("<i class='fa fa-spinner fa-spin'></i> Editing Packages... please wait.");

        $.ajax({
            url: UPDATE_URL,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'package_id': slug,
                'platform_id': platform_id,
                'investment_amount': investment_amount,
                'monthly_charge': monthly_charge,
                'req': 'update_package'
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#edit-package").attr("disabled", false);
                    $("#edit-package").html("<i class='fa fa-check'></i> Edit Store");
                    $("#serverErrors1").html("<div class='success-alert'>" + rst.msg + "</div><br/>");
                    location.reload();
                } else if (rst.type == "false") {
                    $("#edit-package").attr("disabled", false);
                    $("#edit-package").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors1").html("<div class='danger-alert'>" + rst.msg + "</div><br/>");
                }
            },
            error: function(rst) {
                $("#edit-package").attr("disabled", false);
                $("#edit-package").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors1").html("<div class='danger-alert'>" + rst.msg + "</div><br/>");
            }
        });
    }
});
//});

$('body').find("table.table-striped.table-hover.packages tbody tr").each(function(index) {
    $("#edit" + index).on("click", function() {
        $("#edit_package").modal();
        $("#loading").show();
        $("#package_details").hide();
        var package_id = $("#package_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "POST",
            data: {
                '_token': TOKEN,
                'package_id': package_id,
            },
            success: function(rst) {
                $("#loading").hide();
                $("#package_details").fadeIn();
                $("#package_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#package_details").hide();
                $("#serverErrors1").show();
                $("#serverErrors1").html("<div class='danger-alert'>" + errorMessage + "</div>");
            }
        });
    });
});

$('body').find("table.table-striped.table-hover.packages tbody tr").each(function(index) {
    $("#btn_package_delete" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Deleting this Package...");

        //deleting Package
        $.ajax({
            url: $(this).data("href"),
            method: "GET",
            data: {
                _token: TOKEN,
                req: "package_delete"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_package_delete").attr("disabled", false);
                    $("#btn_package_delete").html("<i class='fa fa-check'></i> deleted.");
                    $("#serverErrors").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_package_delete").attr("disabled", false);
                    $("#btn_package_delete").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#btn_package_delete").attr("disabled", false);
                $("#btn_package_delete").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    });
});