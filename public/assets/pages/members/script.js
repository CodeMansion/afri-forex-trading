function showInfoModal() {
    $("#platform").modal({ backdrop: "static", keyboard: false });
    //backdrop prevents closing the modal, keyboard prevents losing with esc key
}

$(document).ready(function() {
    $("#subscribe_pay").hide();
    $("#investment_pay").hide();
    $("#referral").hide();
    $("#close").hide();
    if (subscription_count > 0 || investment_count > 0 || referral_count > 0) {
        $("#close").show();
    } else {
        showInfoModal();
    }

});

$('#platform_id').on('change', function() {
    var platform_id = $('#platform_id').val();
    $("#packages").hide();
    if (platform_id == "") {
        $("#subscribe_pay").hide();
        $("#investment_pay").hide();
        $("#referral").hide();
    } else if (platform_id == 3) {
        $("#subscribe_pay").hide();
        $("#investment_pay").hide();
        $("#referral").show();
    } else {
        $.ajax({
            url: PLATFORM_URL,
            method: "GET",
            data: {
                _token: TOKEN,
                'platform_id': platform_id,
                'req': "add_plaform"
            },
            success: function(rst) {
                $("#packages").fadeIn();
                $("#packages").html(rst);
                if (rst == "") {
                    $("#investment_pay").hide();
                    $("#referral").hide();
                    $("#subscribe_pay").show();
                } else {
                    $("#subscribe_pay").hide();
                    $("#referral").hide();
                    $("#investment_pay").show();
                }
            },
            error: function(rst) {
                $("#packages").hide();
                $("#errors").show();
                $("#errors1").html("<div class='alert-danger'>" + rst + "</div>");
            }
        });
    }

});

$("#subscribe_pay").on("click", function() {
    var platform_id = $("#platform_id").val();
    $("#packages").hide();
    $("#errors").html("");
    $(this).attr("disabled", true);
    $(this).html("<i class='fa fa-refresh fa-spin'></i> Processing...");
    $.ajax({
        url: SUBSCRIBE,
        method: "POST",
        data: {
            '_token': TOKEN,
            'platform_id': platform_id,
            'req': "subscribe"
        },
        success: function(rst) {
            if (rst.type == "true") {
                $("#subscribe_pay").attr("disabled", false);
                $("#subscribe_pay").html("<i class='fa fa-check'></i> Submit!");
                $("#errors").html(
                    "<div class='alert alert-success'>" + rst.msg + "</div><br/>"
                );
                window.setTimeout(function() {
                    $("#platform").modal("hide");
                }, 5000);
            } else if (rst.type == "false") {
                $("#subscribe_pay").attr("disabled", false);
                $("#subscribe_pay").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#errors").html(
                    "<div class='alert alert-danger'>" + rst.msg + "</div><br/>"
                );
            }
        },
        error: function(rst) {
            $("#subscribe_pay").attr("disabled", false);
            $("#subscribe_pay").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
            $("#errors").html(
                "<div class='alert alert-danger'>" + rst.msg + "</div><br/>"
            );
        }
    });
});

$("#referral").on("click", function() {
    var platform_id = $("#platform_id").val();
    $("#packages").hide();
    $("#errors").html("");
    $(this).attr("disabled", true);
    $(this).html("<i class='fa fa-refresh fa-spin'></i> Processing...");
    $.ajax({
        url: REFERRAL,
        method: "POST",
        data: {
            '_token': TOKEN,
            'platform_id': platform_id,
            'req': "referral"
        },
        success: function(rst) {
            if (rst.type == "true") {
                $("#referral").attr("disabled", false);
                $("#referral").html("<i class='fa fa-check'></i> Submit!");
                $("#errors").html(
                    "<div class='alert alert-success'>" + rst.msg + "</div><br/>"
                );
                window.setTimeout(function() {
                    $("#platform").modal("hide");
                }, 5000)
            } else if (rst.type == "false") {
                $("#referral").attr("disabled", false);
                $("#referral").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
                $("#errors").html(
                    "<div class='alert alert-danger'>" + rst.msg + "</div><br/>"
                );
            }
        },
        error: function(rst) {
            $("#referral").attr("disabled", false);
            $("#referral").html("<i class='fa fa-warning fa-spin'></i> Failed. Try Again!");
            $("#errors").html(
                "<div class='alert alert-danger'>" + rst.msg + "</div><br/>"
            );
        }
    });
});

$("#investment_pay").on("click", function() {
    var platform_id = $("#platform_id").val();
    var package_id = $("#package_id").val();
    var package_type_id = $("#package_type_id").val();
    $("#errors").html("");
    if (platform_id.length < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please Fullname can not be empty</div><br/>");
    } else if (package_id.length < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please email can not be empty</div><br/>");
    } else if (package_type_id.length < 1) {
        $("#errors").html("<div class='alert alert-danger'>Please password can not be empty</div><br/>");
    } else {
        $(this).attr("disabled", true);
        $(this).html("<i class='fa fa-refresh fa-spin'></i> Processing...");
        $.ajax({
            url: REFERRAL,
            method: "POST",
            data: {
                '_token': TOKEN,
                'platform_id': platform_id,
                'package_id': package_id,
                'package_type_id': package_type_id,
                'req': "investment_pay"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#investment_pay").attr("disabled", false);
                    $("#investment_pay").html(
                        "<i class='fa fa-check'></i> Submit!"
                    );
                    $("#errors").html(
                        "<div class='alert alert-success'>" +
                        rst.msg +
                        "</div><br/>"
                    );
                    window.setTimeout(function() {
                        $("#platform").modal("hide");
                    }, 5000);
                } else if (rst.type == "false") {
                    $("#investment_pay").attr("disabled", false);
                    $("#investment_pay").html(
                        "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                    );
                    $("#errors").html(
                        "<div class='alert alert-danger'>" +
                        rst.msg +
                        "</div><br/>"
                    );
                }
            },
            error: function(rst) {
                $("#investment_pay").attr("disabled", false);
                $("#investment_pay").html(
                    "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                );
                $("#errors").html(
                    "<div class='alert alert-danger'>" +
                    rst.msg +
                    "</div><br/>"
                );
            }
        });
    }
});