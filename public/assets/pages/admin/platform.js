//adding new store
$("#add-platform").on("click", function() {
    var name = $("#name").val();
    var is_multiple = $("#is_multiple").val();
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
$('body').find("#supplier_type_details").on("click ", "#edit-supplier-type", function() {
    var name = $("#name1").val();
    var slug = $("#slug1").val();
    var code = $("#code1").val();
    if (name.length < 1) {
        $("#serverErrors1").html("<div class='danger-alert'>Please enter a value for name</div><br/>");
    } else if (code.length < 1) {
        $("#serverErrors1").html("<div class='danger-alert'>Please enter a value for description</div><br/>");
    } else {
        $("#serverErrors1").html("");
        $(this).attr('disabled', true);
        $(this).html("<i class='fa fa-spinner fa-spin'></i> Editing Store... please wait.");

        $.ajax({
            url: UPDATE_URL,
            method: "POST",
            data: {
                '_token': TOKEN,
                'name': name,
                'slug': slug,
                'code': code
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#edit-supplier-type").attr('disabled', false);
                    $("#edit-supplier-type").html("<i class='fa fa-check'></i> Edit Store");
                    $("#serverErrors1").html("<div class='success-alert'>" + rst.msg + "</div><br/>");
                    location.reload();
                } else if (rst.type == "false") {
                    $("#edit-supplier-type").attr('disabled', false);
                    $("#edit-supplier-type").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors1").html("<div class='danger-alert'>" + rst.msg + "</div><br/>");
                }
            },
            error: function(rst) {
                $("#edit-supplier-type").attr('disabled', false);
                $("#edit-supplier-type").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors1").html("<div class='danger-alert'>" + rst.msg + "</div><br/>");
            }
        });
    }
});
//});

$('body').find("table.table-striped.table-hover.store_detatils tbody tr").each(function(index) {
    $("#edit" + index).on("click", function() {
        $("#supplier_type_details").hide();
        $("#loading").show();
        $("#edit_supplier_type").modal();
        var supplier_type_id = $("#supplier_type_id" + index).val();

        $.ajax({
            url: GET_EDIT_INFO,
            method: "POST",
            data: {
                '_token': TOKEN,
                'supplier_type_id': supplier_type_id,
            },
            success: function(rst) {
                $("#loading").hide();
                $("#supplier_type_details").fadeIn();
                $("#supplier_type_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#supplier_type_details").hide();
                $("#serverErrors1").show();
                $("#serverErrors1").html("<div class='danger-alert'>" + errorMessage + "</div>");
            }
        });
    });
});

$('body').find("table.table-striped.table-hover.store_detatils tbody tr").each(function(index) {
    $("#btn_supplier_type_delete" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr('disabled', true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Deleting this type item unit...");

        //processing the new expense
        $.ajax({
            url: $(this).data('href'),
            method: "GET",
            data: {
                '_token': TOKEN,
                'req': 'supplier_type_delete'
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $(".btn_supplier_type_delete").attr('disabled', false);
                    $(".btn_supplier_type_delete").html("<i class='fa fa-check'></i> deleted.");
                    $("#serverErrors").html("<div class='success-alert'>" + rst.msg + "</div><br/>");
                    location.reload();
                } else if (rst.type == "false") {
                    $(".btn_supplier_type_delete").attr('disabled', false);
                    $(".btn_supplier_type_delete").html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html("<div class='danger-alert'>" + rst.msg + "</div><br/>");
                }
            },
            error: function(rst) {
                $(".btn_supplier_type_delete").attr('disabled', false);
                $(".btn_supplier_type_delete").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html("<div class='danger-alert'>" + rst.msg + "</div><br/>");
            }
        });
    });
});