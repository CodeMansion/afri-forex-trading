//adding new store
$("#add-platform").on("click", function() {
    var name = $("#name").val();
    var is_multiple = $("#is_multiple").val();
    var price = $("#price").val();
    var recycle_price = $("#recycle_price").val();
    if (name.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please enter a value for NAME</div><br/>");
    } else if (is_multiple.length < 1) {
        $("#serverError").html("<div class='danger-alert'>Please select type</div><br/>");
    } else {
        $("#serverError").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Adding New Platform...");

        //processing the new expense
        $.ajax({
            url: ADDPLATFORM,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'is_multiple': is_multiple,
                'price': price,
                'recycle_price': recycle_price,
                'req': "add_platform"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#add-platform").attr(
                        "disabled",
                        false
                    );
                    $("#add-platform").html(
                        "<i class='fa fa-check'></i> Add Platform"
                    );
                    $("#serverError").html(
                        "<div class='success-alert'>" +
                        rst.msg +
                        "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#add-platform").attr(
                        "disabled",
                        false
                    );
                    $("#add-platform").html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    $("#serverError").html(
                        "<div class='danger-alert'>" +
                        rst.msg +
                        "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#add-platform").attr("disabled", false);
                $("#add-platform").html(
                    "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                );
                $("#serverError").html(
                    "<div class='danger-alert'>" +
                    rst.msg +
                    "</div><br/>"
                );
            }
        });
    }
});

//$("#modal .modal").each(function(index) {
$('body').find("#platform_details").on("click ", "#edit-platform", function() {
    var name = $("#name1").val();
    var is_multiple = $("#is_multiple1").val();
    var slug = $("#slug").val();
    var price = $('#price1').val();
    var recycle_price = $('#recycle_price1').val();
    if (name.length < 1) {
        $("#serverErrors1").html("<div class='danger-alert'>Please enter a value for name</div><br/>");
    } else if (is_multiple.length < 1) {
        $("#serverErrors1").html("<div class='danger-alert'>Please select a value for type</div><br/>");
    } else {
        $("#serverErrors1").html("");
        $(this).attr('disabled', true);
        $(this).html("<i class='fa fa-spinner fa-spin'></i> Editing Platform... please wait.");

        $.ajax({
            url: UPDATE_URL,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'platform_id': slug,
                'is_multiple': is_multiple,
                'price': price,
                'recycle_price': recycle_price,
                'req': 'update_platform'
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#edit-platform").attr("disabled", false);
                    $("#edit-platform").html("<i class='fa fa-check'></i> Edit Store");
                    $("#serverErrors1").html("<div class='success-alert'>" + rst.msg + "</div><br/>");
                    location.reload();
                } else if (rst.type == "false") {
                    $("#edit-platform").attr('disabled', false);
                    $("#edit-platform").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors1").html("<div class='danger-alert'>" + rst.msg + "</div><br/>");
                }
            },
            error: function(rst) {
                $("#edit-platform").attr('disabled', false);
                $("#edit-platform").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors1").html("<div class='danger-alert'>" + rst.msg + "</div><br/>");
            }
        });
    }
});
//});

$('body').find("table.table-striped.table-hover.platforms tbody tr").each(function(index) {
    $("#edit" + index).on("click", function() {
        $("#edit_platform").modal();
        $("#loading").show();
        $("#platform_details").hide();
        var platform_id = $("#platform_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "POST",
            data: {
                '_token': TOKEN,
                'platform_id': platform_id,
            },
            success: function(rst) {
                $("#loading").hide();
                $("#platform_details").fadeIn();
                $("#platform_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#platform_details").hide();
                $("#serverErrors1").show();
                $("#serverErrors1").html("<div class='danger-alert'>" + errorMessage + "</div>");
            }
        });
    });
});

$('body').find("table.table-striped.table-hover.platforms tbody tr").each(function(index) {
    $("#btn_platform_delete" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Deleting this Platform...");

        //deleting Platform
        $.ajax({
            url: $(this).data("href"),
            method: "GET",
            data: {
                '_token': TOKEN,
                'req': "platform_delete"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_platform_delete").attr("disabled", false);
                    $("#btn_platform_delete").html("<i class='fa fa-check'></i> deleted.");
                    $("#serverErrors").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_platform_delete").attr("disabled", false);
                    $("#btn_platform_delete").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#btn_platform_delete").attr("disabled", false);
                $("#btn_platform_delete").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    });
});

$('body').find("table.table-striped.table-hover.platforms tbody tr").each(function(index) {
    $("#activate" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Activating this Platform...");

        //deleting Platform
        $.ajax({
            url: $(this).data("href"),
            method: "GET",
            data: {
                '_token': TOKEN,
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#activate").attr("disabled", false);
                    $("#activate").html("<i class='fa fa-check'></i> Not Active.");
                    $("#serverErrors").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#activate").attr("disabled", false);
                    $("#activate").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#activate").attr("disabled", false);
                $("#activate").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    });
});

$('body').find("table.table-striped.table-hover.platforms tbody tr").each(function(index) {
    $("#deactivate" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> De-activating this Platform...");

        //deleting Platform
        $.ajax({
            url: $(this).data("href"),
            method: "GET",
            data: {},
            success: function(rst) {
                if (rst.type == "true") {
                    $("#deactivate").attr("disabled", false);
                    $("#deactivate").html("<i class='fa fa-check'></i> Active.");
                    $("#serverErrors").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#deactivate").attr("disabled", false);
                    $("#deactivate").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#deactivate").attr("disabled", false);
                $("#deactivate").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    });
});