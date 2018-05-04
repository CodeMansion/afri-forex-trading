var AppTestimony = (function() {
    var loadComponents = function() {
        $("#loader").hide();
        $("body").find("#loading").hide();
    };

    var CreateTestimony = function() {
        var subject = $("#title").val();
        var message = tinymce.activeEditor.getContent();

        $("#errors").html("");

        if (subject.length < 1) {
            App.scrollTop($("#errors"));
            $("#errors").html("<div class='alert alert-danger'>Please provide testimony title</div>");
        } else {
            $("#create_new_testimony_btn").attr("disabled", true);
            $("#loader").show();

            $.ajax({
                url: SEND,
                method: "POST",
                data: {
                    '_token': TOKEN,
                    'title': subject,
                    'message': message
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        App.scrollTop($("#errors"));
                        $("#create_new_testimony_btn").attr("disabled", false);
                        $("#loader").hide();
                        $("#errors").html(
                            "<div class='alert alert-success'>" + rst.msg + "</div>"
                        );
                        location.reload();
                    } else if (rst.type) {
                        App.scrollTop($("#errors"));
                        $("#create_new_testimony_btn").attr("disabled", false);
                        $("#loader").hide();
                        $("#errors").html(
                            "<div class='alert alert-danger'>" + rst.msg + "</div>"
                        );
                    }
                },
                error: function(rst, httpErr, errorMessage) {
                    $("#create_new_testimony_btn").attr("disabled", false);
                    $("#loader").hide();
                    $("#errors").html(
                        "<div class='alert alert-danger'>" + errorMessage + "</div>"
                    );
                }
            });
        }
    };

    var getTestimonyDetails = function(index) {
        $("#errors1").html("");
        $("#edit_testimony").modal();
        $("#loading").show();
        $("#testimony_details").hide();
        var testimony_id = $("#testimony_id" + index).val();

        $.ajax({
            url: GET_DETAILS,
            method: "POST",
            data: {
                '_token': TOKEN,
                'testimony_id': testimony_id
            },
            success: function(rst) {
                $("#loading").hide();
                $("#testimony_details").fadeIn();
                $("#testimony_details").html(rst);
            },
            error: function(jqXHR, textStatus, errorMessage) {
                $("#loading").hide();
                $("#testimony_details").hide();
                $("#errors1").show();
                $("#errors1").html("<div class='danger-alert'>" + errorMessage + "</div>");
            }
        });
    };

    var UpdateTestimony = function() {
        var subject = $("#title1").val();
        var message = $('#message').val();
        var slug = $('#slug').val();

        $("#errors1").html("");

        if (subject.length < 1) {
            App.scrollTop($("#errors"));
            $("#errors1").html("<div class='alert alert-danger'>Please provide testimony title</div>");
        } else {
            $("#update_testimony_btn").attr("disabled", true);
            $("#loader").show();

            $.ajax({
                url: SEND,
                method: "POST",
                data: {
                    '_token': TOKEN,
                    'id': slug,
                    'title': subject,
                    'message': message
                },
                success: function(rst) {
                    if (rst.type == "true") {
                        App.scrollTop($("#errors"));
                        $("#update_testimony_btn").attr("disabled", false);
                        $("#loader").hide();
                        $("#errors1").html(
                            "<div class='alert alert-success'>" + rst.msg + "</div>"
                        );
                        location.reload();
                    } else if (rst.type) {
                        App.scrollTop($("#errors"));
                        $("#update_testimony_btn").attr("disabled", false);
                        $("#loader").hide();
                        $("#errors1").html(
                            "<div class='alert alert-danger'>" + rst.msg + "</div>"
                        );
                    }
                },
                error: function(rst, httpErr, errorMessage) {
                    $("#update_testimony_btn").attr("disabled", false);
                    $("#loader").hide();
                    $("#errors1").html(
                        "<div class='alert alert-danger'>" + errorMessage + "</div>"
                    );
                }
            });
        }
    }

    return {
        init: function() {
            loadComponents();

            $("#create_new_testimony_btn").on("click", function() {
                CreateTestimony();
            });

            $('body').find("table.table-striped.table-hover.table-bordered.testimonies_list tbody tr").each(function(index) {
                $("#edit" + index).on("click", function() {
                    getTestimonyDetails(index);
                });
            });

            $('body').find("#testimony_details").on("click ", "#update_testimony_btn", function() {
                UpdateTestimony();
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
        }
    };
})();

jQuery(document).ready(function() {
    AppTestimony.init();
});