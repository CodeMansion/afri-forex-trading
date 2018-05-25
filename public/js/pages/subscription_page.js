var AppServiceSubscription = function() {

    var loadServices = function() {
        $("#service_page").show();
        $("#select_packages").hide();
        $("#select_package_types").hide();
        $("#loading").hide();
        $("#return_back").hide();
    }

    var ReturnBack = function() {
        $("#select_packages").hide();
        $("#select_package_types").hide();
        $("#return_back").hide();
        $("#service_page").show();
    }

    var selectPlatform = function(id, type) {
        $("#service_page").fadeOut();
        $("#loading").show();

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
                    $("#loading").hide();
                    $("#service_page").hide();
                    $("#return_back").show();
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
                        $("#loading").hide();
                        $("#service_page").hide();
                        $("#select_packages").fadeIn();
                        $("#return_back").show();
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
                        $("#loading").hide();
                        $("#service_page").hide();
                        $("#select_packages").fadeIn();
                        $("#return_back").show();
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
                    }, 2000);
                } else if (data.type == "false") {
                    toastr.warning(data.msg);
                    swal("error!", data.msg, "error");
                    setTimeout(() => {
                        window.location.replace("/dashboard");
                    }, 2000);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Error", errorMsg, "error");
                $("#payment_btn").attr('disabled', false);
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
                    }, 2000);
                } else if (rst.type == "false") {
                    toastr.warning(rst.msg);
                    swal("error!", rst.msg, "error");
                    setTimeout(() => {
                        window.location.replace("/dashboard");
                    }, 2000);
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Error", errorMsg, "error");
                $("#payment_btn").attr('disabled', false);
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
                    }, 2000);
                } else if (rst.type == "false") {}
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Error", errorMsg, "error");
                $("#payment_btn").attr('disabled', false);
            }
        });
    }

    var cancel = function() {
        $("#select_packages").hide();
        $("#service_page").fadeIn();
    }

    var SubscribeWithPaystack = function(id, amount, email) {
        var handler = PaystackPop.setup({
            key: 'pk_test_dd3e598daa02068d4a06e54a86e9dc0cd4f244ea',
            email: email,
            amount: amount + "00",
            metadata: {
                custom_fields: [{
                    display_name: "Mobile Number",
                    variable_name: "mobile_number",
                    value: "{{auth()->user()->phone}}"
                }, ]
            },
            callback: function(response) {
                processPayment(id, amount);
                //alert('success. transaction ref is ' + response.reference);                
            },
            onClose: function() {
                alert('window closed');
            }
        });
        handler.openIframe();
    }

    var InvestWithPaystack = function(platform_id, package_id, package_type_id, amount, email) {
        toastr.success("Payment is processing...");
        var handler = PaystackPop.setup({
            key: 'pk_test_dd3e598daa02068d4a06e54a86e9dc0cd4f244ea',
            email: email,
            amount: amount + "00",
            metadata: {
                custom_fields: [{
                    display_name: "Mobile Number",
                    variable_name: "mobile_number",
                    value: "{{auth()->user()->phone}}"
                }, ]
            },
            callback: function(response) {
                Invest(platform_id, package_id, package_type_id);
                //alert('success. transaction ref is ' + response.reference);                
            },
            onClose: function() {
                alert('window closed');
            }
        });
        handler.openIframe();
    }

    return {
        init: function() {

            loadServices();

            $('body').find("#return_back").on("click", function() {
                ReturnBack();
            });

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

            $('body').find("#select_packages").on("click", "#payment_btn_stack", function() {
                $(this).attr('disabled', true);
                var amount = $("#amount").val();
                var converted_amount;
                app_id = "d257b9a017904f8284e4452b6562eca2"; // your unique app id goes here
                uri = encodeURI("http://openexchangerates.org/latest.json?app_id=" + app_id);

                var id = $("#select_packages").find("#platform_id").val();
                swal({
                    title: "Are you sure?",
                    text: "You are about to make payment for a service",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: cancel(),
                    showLoaderOnConfirm: true
                }, function() {
                    $.get(uri, function(json) {
                        my_base = "USD";
                        my_destination = "NGN";
                        amount = amount;
                        converted_amount = (amount / json.rates[my_base]) * json.rates[my_destination];
                        SubscribeWithPaystack(id, Math.round(converted_amount), USER_EMAIL);
                    }, "jsonp");

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
                    closeOnConfirm: cancel(),
                    showLoaderOnConfirm: true
                }, function() {
                    Referrer(id);
                });
            });

            $('body').find("#select_packages").on("click", "#invest", function() {
                $(this).attr('disabled', true);
                var platform_id = $("#select_packages").find("#platform_id").val();
                var package_id = $("#select_packages").find("#package_id").val();
                var package_type_id = $("#select_packages").find("#package_type_id").val();
                var amount = $("#select_packages").find("#amount").val();
                app_id = "d257b9a017904f8284e4452b6562eca2"; // your unique app id goes here
                uri = encodeURI("http://openexchangerates.org/latest.json?app_id=" + app_id);
                swal({
                    title: "Are you sure?",
                    text: "You are about to make payment for a service",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: cancel(),
                    showLoaderOnConfirm: true
                }, function() {
                    $.get(uri, function(json) {
                        my_base = "USD";
                        my_destination = "NGN";
                        amount = amount;
                        converted_amount = (amount / json.rates[my_base]) * json.rates[my_destination];
                        InvestWithPaystack(platform_id, package_id, package_type_id, Math.round(converted_amount), USER_EMAIL);
                    }, "jsonp");
                });
            });
        }
    }

}();

jQuery(document).ready(function() {
    AppServiceSubscription.init();
});