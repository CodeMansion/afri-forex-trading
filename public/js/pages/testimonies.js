var AppTestimony = (function() {
    var loadComponents = function() {
        $("#loader").hide();
        $("#loader1").hide();
        $("body").find("#loading").hide();
    };

    var CreateTestimony = function() {
        var subject = $("#title").val();
        var message = $("#test_message").val();

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
                        toastr.success(rst.msg);
                        location.reload();
                    } else if (rst.type) {
                        App.scrollTop($("#errors"));
                        $("#create_new_testimony_btn").attr("disabled", false);
                        $("#loader").hide();
                        $("#errors").html(
                            "<div class='alert alert-danger'>" + rst.msg + "</div>"
                        );
                        toastr.warning(rst.msg);
                    }
                },
                error: function(rst, httpErr, errorMessage) {
                    $("#create_new_testimony_btn").attr("disabled", false);
                    $("#loader").hide();
                    $("#errors").html(
                        "<div class='alert alert-danger'>" + errorMessage + "</div>"
                    );
                    toastr.error(errorMessage);
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
        var message = $("#message1").val();
        var slug = $('#slug').val();

        $("#errors1").html("");

        if (subject.length < 1) {
            App.scrollTop($("#errors"));
            $("#errors1").html("<div class='alert alert-danger'>Please provide testimony title</div>");
        } else {
            $("#update_testimony_btn").attr("disabled", true);
            $("#loader").show();

            $.ajax({
                url: UPDATE,
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
                        toastr.success(rst.msg);
                        location.reload();
                    } else if (rst.type) {
                        App.scrollTop($("#errors"));
                        $("#update_testimony_btn").attr("disabled", false);
                        $("#loader").hide();
                        $("#errors1").html(
                            "<div class='alert alert-danger'>" + rst.msg + "</div>"
                        );
                        toastr.warning(rst.msg);
                    }
                },
                error: function(rst, httpErr, errorMessage) {
                    $("#update_testimony_btn").attr("disabled", false);
                    $("#loader").hide();
                    $("#errors1").html(
                        "<div class='alert alert-danger'>" + errorMessage + "</div>"
                    );
                    toastr.error(errorMessage);
                }
            });
        }
    }

    var DeleteTestimony = function(index) {
        $("#btn_testimony_delete" + index).attr("disabled", true);
        $("#btn_testimony_delete" + index).html("<i class='fa fa-refresh fa-spin'></i> Deleting this Testimony...");

        //deleting Testimony
        $.ajax({
            url: $("#btn_testimony_delete" + index).data("href"),
            method: "GET",
            data: {},
            success: function(rst) {
                if (rst.type == "true") {
                    $("#btn_testimony_delete" + index).attr(
                        "disabled",
                        false
                    );
                    $("#btn_testimony_delete" + index).html(
                        "<i class='fa fa-check'></i> deleted."
                    );
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#btn_testimony_delete" + index).attr(
                        "disabled",
                        false
                    );
                    $("#btn_testimony_delete" + index).html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    toastr.warning(rst.msg);
                }
            },
            error: function(rst) {
                $("#btn_testimony_delete" + index).attr("disabled", false);
                $("#btn_testimony_delete" + index).html(
                    "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                );
                toastr.error(rst.msg);
            }
        });
    }

    var ActivateTestimony = function(index) {
        $("#activate" + index).attr("disabled", true);
        $("#activate" + index).html("<i class='fa fa-refresh fa-spin'></i> Approving this Testimony...");

        //deleting Testimony
        $.ajax({
            url: $("#activate" + index).data("href"),
            method: "GET",
            data: {
                '_token': TOKEN
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#activate" + index).attr("disabled", false);
                    $("#activate" + index).html(
                        "<i class='fa fa-check'></i> Approved."
                    );
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#activate" + index).attr("disabled", false);
                    $("#activate" + index).html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    toastr.warning(rst.msg);
                }
            },
            error: function(rst) {
                $("#activate" + index).attr("disabled", false);
                $("#activate" + index).html(
                    "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                );
                toastr.error(rst.msg);
            }
        });
    };

    var DeclineTestimony = function(index) {
        $("#decline" + index).attr("disabled", true);
        $("#decline" + index).html("<i class='fa fa-refresh fa-spin'></i> Approving this Testimony...");

        //deleting Testimony
        $.ajax({
            url: $("#decline" + index).data("href"),
            method: "GET",
            data: {
                '_token': TOKEN
            },
            success: function(rst) {
                if (rst.type == "true") {
                    $("#decline" + index).attr("disabled", false);
                    $("#decline" + index).html(
                        "<i class='fa fa-check'></i> Approved."
                    );
                    toastr.success(rst.msg);
                    location.reload();
                } else if (rst.type == "false") {
                    $("#decline" + index).attr("disabled", false);
                    $("#decline" + index).html(
                        "<i class='fa fa-warning'></i> Failed! Try Again."
                    );
                    toastr.warning(rst.msg);
                }
            },
            error: function(rst) {
                $("#decline" + index).attr("disabled", false);
                $("#decline" + index).html(
                    "<i class='fa fa-warning fa-spin'></i> Failed. Try Again!"
                );
                toastr.error(rst.msg);
            }
        });
    };

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

            $('body').find("table.table-striped.table-hover.testimonies_list tbody tr").each(function(index) {
                $("#btn_testimony_delete" + index).on("click", function() {
                    $("#serverErrors").html("");
                    DeleteTestimony(index);
                });
            });

            $('body').find("table.table-striped.table-hover.testimonies_list tbody tr").each(function(index) {
                $("#activate" + index).on("click", function() {
                    $("#serverErrors").html("");
                    ActivateTestimony(index);
                });
            });

            $('body').find("table.table-striped.table-hover.testimonies_list tbody tr").each(function(index) {
                $("#decline" + index).on("click", function() {
                    $("#serverErrors").html("");
                    DeclineTestimony(index);
                });
            });
        }
    };
})();

jQuery(document).ready(function() {
    AppTestimony.init();
});