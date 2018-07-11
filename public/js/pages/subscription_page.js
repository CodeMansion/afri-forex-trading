const AppServiceSubscription = function() {

    let app_id = "d257b9a017904f8284e4452b6562eca2";
    let uri = encodeURI("http://openexchangerates.org/latest.json?app_id=" + app_id);

    const ProcessPayment = function() {
        $.ajax({
            url: PAYMENT,
            method: "POST",
            data: {
                'platform': $('body').data('platform'),
                'amount': $('body').data('amount'),
                'package_id': $('body').data('package_id'),
                'package_type_id': $('body').data('package_type_id'),
                '_token': TOKEN
            },
            success: function(data) {
                if (data.type == "true") {
                    swal("Payment Successful", data.msg, "success");
                    setTimeout(() => {
                        window.location.replace("/dashboard");
                    }, 2000);
                } else if (data.type == "false") {
                    swal(data.head, data.msg, "error");
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Please try again", errorMsg, "error");
                $("#payment_btn").attr('disabled', false);
            }
        });
    }

    const failedFunction = function(transaction_id) {
        swal("Transaction Failed",'Failed',"error");
    }

    const successFunction = function(transaction_id) {
        // swal("Transaction completed",'success',"success");
        ProcessPayment();
    }

    const closedFunction = function() {
        swal("Connection Closed",'Failed',"error");
    }

    const PayWithVoguePay = function(amount,description) {
        Voguepay.init({
            v_merchant_id: '6162-0064824',
            total: amount,
            cur: 'NGN',
            memo: description,
            recurrent: false,
            frequency: 10,
            
            closed: closedFunction,
            success: successFunction,
            failed: failedFunction
       });
    }


    const PayWithWallet = function(platform,amount,package_id=null,package_type_id=null) {
        $.ajax({
            url: pay_with_wallet,
            method: "POST",
            data: {
                'platform': platform,
                'amount': amount,
                'package_id': package_id,
                'package_type_id': package_type_id,
                '_token': TOKEN
            },
            success: function(data) {
                if (data.type == "true") {
                    swal("Payment Successful", data.msg, "success");
                    setTimeout(() => {
                        window.location.replace("/dashboard");
                    }, 2000);
                } else if (data.type == "false") {
                    swal(data.head, data.msg, "error");
                }
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Something Went Wrong", errorMsg, "error");
            }
        });
    }

    return {
        init: function() {
            $("#PayWithWallet").on("click", function() {
                let amount = $("#amount").val();

                swal({
                    title: "Are you sure?",
                    text: "You are about to pay for an investment",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function() {
                    PayWithWallet(1,amount);
                });   
           });

           $("#PayWithWalletInvest").on("click", function() {
                let amount = $("#invest_amount").val();
                let package_id = $("#package_id").val();
                let package_type_id = $("#package_type_id").val();

                swal({
                    title: "Are you sure?",
                    text: "You are about to pay for an investment",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function() {
                    PayWithWallet(2,amount,package_id,package_type_id);
                });   
            });

            $("#ConfirmReferral").on("click", function() {
                swal({
                    title: "Are you sure?",
                    text: "You are about to pay for an investment",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function() {
                    ProcessPayment(3);
                }); 
           });

            $("input[type=image][name=InvestWithVoguePay]").on("click", function() {
                let description = $("#invest_payment_description").val();
                let amount = $("#invest_amount").val();
                let package_id = $("#package_id").val();
                let package_type_id = $("#package_type_id").val();
                var converted_amount = 0;

                swal({
                    title: "Are you sure?",
                    text: "You are about to pay for an investment",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function() {
                    $('body').data('amount', amount);
                    $('body').data('platform', 2);
                    $('body').data('package_id', package_id);
                    $('body').data('package_type_id', package_type_id);

                    $.get(uri, function(json) {
                        my_base = "USD";
                        my_destination = "NGN";
                        amount = amount;
                        converted_amount = (amount / json.rates[my_base]) * json.rates[my_destination];
                        PayWithVoguePay(Math.round(converted_amount),description);
                        // ProcessPayment();
                    }, "jsonp");
                });   
            });


            $("input[type=image][name=SubscribeWithVoguePay]").on("click", function() {
                let description = $("#payment_description").val();
                let amount = $("#amount").val();
                var converted_amount = 0;

                swal({
                    title: "Are you sure?",
                    text: "You are about to pay for an investment",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function() {
                    $('body').data('amount', amount);
                    $('body').data('platform', 1);
                    $('body').data('package_id', null);
                    $('body').data('package_type_id', null);

                    $.get(uri, function(json) {
                        my_base = "USD";
                        my_destination = "NGN";
                        amount = amount;
                        converted_amount = (amount / json.rates[my_base]) * json.rates[my_destination];
                        PayWithVoguePay(Math.round(converted_amount),description);
                        // ProcessPayment()
                    }, "jsonp");
                });   
            });
        }
    }

}();

jQuery(document).ready(function() {
    AppServiceSubscription.init();
});