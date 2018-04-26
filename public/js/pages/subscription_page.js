var AppServiceSubscription = function() {

    var loadServices = function() {
        $("#service_page").show();
        $("#select_packages").hide();
        $("#select_package_types").hide();
    }

    var selectPlatform = function(id, type) {

        if (type == 1) {
            toastr.info("You selected Investment!");
            $.ajax({
                url: IN_URL,
                method: "POST",
                data: {
                    'id': id,
                    '_token': TOKEN
                },
                success: function(data) {
                    $("#loader").hide();
                    $("#service_page").hide();
                    $("#select_packages").fadeIn();
                    $("#select_packages").html(data);
                },
                error: function(alaxB, HTTerror, errorMsg) {
                    toastr.error(errorMsg);
                }
            });
        }

        if (type == 0) {
            if (id == 1) {
                toastr.info("You selected Daily Signal!");
                $.ajax({
                    url: DS_URL,
                    method: "POST",
                    data: {
                        id: id,
                        _token: TOKEN
                    },
                    success: function(data) {
                        $("#loader").hide();
                        $("#service_page").hide();
                        $("#select_packages").fadeIn();
                        $("#select_packages").html(data);
                    },
                    error: function(alaxB, HTTerror, errorMsg) {
                        toastr.error(errorMsg);
                    }
                });
            } else {
                toastr.info("You selected Referrer!");
                $.ajax({
                    url: REF_URL,
                    method: "POST",
                    data: {
                        id: id,
                        _token: TOKEN
                    },
                    success: function(data) {
                        $("#loader").hide();
                        $("#service_page").hide();
                        $("#select_package_types").hide();
                        $("#select_packages").fadeIn();
                        $("#select_packages").html(data);
                    },
                    error: function(alaxB, HTTerror, errorMsg) {
                        toastr.error(errorMsg);
                    }
                });
            }

        }

    }

    var processPayment = function(type, amount) {
        $.ajax({
            url: PAYMENT,
            method: "POST",
            data: {
                'id': type,
                'amount': amount,
                '_token': TOKEN
            },
            success: function(data) {
                if (data.type == "true") {
                    swal("Successful!", data.msg, "success");
                    setTimeout(() => {
                        window.location.replace("/dashboard");
                    }, 3000);
                } else if (data.type == "false") {
                    toastr.warning(data.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Error", errorMsg, "error");
            }
        });
    }

    var Referrer = function(id) {
        $.ajax({
            url: REFERRAL,
            method: "POST",
            data: {
                '_token': TOKEN,
                'platform_id': id,
                'req': "referral"
            },
            success: function(rst) {
                if (rst.type == "true") {
                    swal("Successful!", rst.msg, "success");
                    setTimeout(() => {
                        window.location.replace("/dashboard");
                    }, 3000);
                } else if (rst.type == "false") {
                    toastr.warning(rst.msg);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Error", errorMsg, "error");
            }
        });
    }

    var Invest = function(platform_id, package_id, package_type_id) {
        $.ajax({
            url: INVEST,
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
                    swal("Successful!", rst.msg, "success");
                    setTimeout(() => {
                        window.location.replace("/dashboard");
                    }, 3000);
                } else if (rst.type == "false") {}
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Error", errorMsg, "error");
            }
        });
    }

    return {
        init: function() {

            loadServices();

            $('body').find("#service_page .platform").each(function(index) {
                $("#select_platform_" + index).on("click", function() {
                    var type = $("#platform_type_" + index).val();
                    var id = $("#platform_id_" + index).val();
                    selectPlatform(id, type);
                });
            });

            $('body').find("#select_packages").on("click", "#return_back", function() {
                $("#select_packages").hide();
                $("#service_page").fadeIn();
            });

            $('body').find("#select_packages").on("click", "#package_type", function() {
                $("#select_packages").hide();
                $("#select_package_types").fadeIn();
            });

            $('body').find("#select_package_types .package_types").each(function(index) {
                $("#continue" + index).on("click", function() {
                    //$(this).attr('disabled', true);
                    var platform_id = $("#select_packages").find("#platform_id").val();
                    var package_id = $("#select_packages").find("#package_id" + index).val();
                    var package_type_id = $("#select_package_types").find("#package_type_id" + index).val();
                    toastr.info("Proceeding To Payment!");
                    $.ajax({
                        url: IN_PAYMENT_INFO_URL,
                        method: "POST",
                        data: {
                            'platform_id': platform_id,
                            'package_id': package_id,
                            'package_type_id': package_type_id,
                            '_token': TOKEN
                        },
                        success: function(data) {
                            $("#loader").hide();
                            $("#service_page").hide();
                            $("#select_package_types").hide();
                            $("#select_packages").hide();
                            $("#select_packages").fadeIn();
                            $("#select_packages").html(data);
                        },
                        error: function(alaxB, HTTerror, errorMsg) {
                            toastr.error(errorMsg);
                        }
                    });
                });
            })

            $('body').find("#select_packages").on("click", "#payment_btn", function() {
                $(this).attr('disabled', true);
                var amount = $("#amount").val();
                var id = $("#select_packages").find("#platform_id").val();
                swal({
                        title: "Are you sure?",
                        text: "You are about to make payment for a service",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, Make Payment!",
                        closeOnConfirm: false
                    },
                    function() {
                        processPayment(id, amount);
                    });
            });

            $('body').find("#select_packages").on("click", "#referral", function() {
                $(this).attr('disabled', true);
                var id = $("#select_packages").find("#platform_id").val();
                swal({
                        title: "Are you sure?",
                        text: "You are about to make payment for a service",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, Proceed!",
                        closeOnConfirm: false
                    },
                    function() {
                        Referrer(id);
                    });
            });

            $('body').find("#select_packages").on("click", "#invest", function() {
                $(this).attr('disabled', true);
                var platform_id = $("#select_packages").find("#platform_id").val();
                var package_id = $("#select_packages").find("#package_id").val();
                var package_type_id = $("#select_packages").find("#package_type_id").val();
                swal({
                        title: "Are you sure?",
                        text: "You are about to make payment for a service",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, Proceed!",
                        closeOnConfirm: false
                    },
                    function() {
                        Invest(platform_id, package_id, package_type_id);
                    });
            });
        }
    }

}();

jQuery(document).ready(function() {
    AppServiceSubscription.init();
});