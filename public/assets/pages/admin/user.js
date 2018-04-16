$('body').find("table.table-striped.table-hover.users tbody tr").each(function(index) {
    $("#activate" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Activating this Platform...");

        //deleting Platform
        $.ajax({
            url: $(this).data("href"),
            method: "GET",
            data: {},
            success: function(rst) {
                if (rst.type == "true") {
                    $("#activate" + index).attr("disabled", false);
                    $("#activate" + index).html("<i class='fa fa-check'></i> Not Active.");
                    $("#serverErrors").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#activate" + index).attr("disabled", false);
                    $("#activate" + index).html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#activate" + index).attr("disabled", false);
                $("#activate" + index).html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    });
});

$('body').find("table.table-striped.table-hover.users tbody tr").each(function(index) {
    $("#deactivate" + index).on("click", function() {
        $("#serverErrors").html("");
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> De-activating this User...");

        //deleting Platform
        $.ajax({
            url: $(this).data("href"),
            method: "GET",
            data: {},
            success: function(rst) {
                if (rst.type == "true") {
                    $("#deactivate" + index).attr("disabled", false);
                    $("#deactivate" + index).html("<i class='fa fa-check'></i> Active.");
                    $("#serverErrors").html(
                        "<div class='success-alert'>" + rst.msg + "</div><br/>"
                    );
                    location.reload();
                } else if (rst.type == "false") {
                    $("#deactivate" + index).attr("disabled", false);
                    $("#deactivate" + index).html("<i class='fa fa-warning'></i> Failed! Try Again.");
                    $("#serverErrors").html(
                        "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#deactivate" + index).attr("disabled", false);
                $("#deactivate" + index).html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#serverErrors").html(
                    "<div class='danger-alert'>" + rst.msg + "</div><br/>"
                );
            }
        });
    });
});