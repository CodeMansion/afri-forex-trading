const AppServiceSubscription = function() {

    const ProcessPayment = function(platform, amount=null, package_id=null, package_type_id=null) {
        $.ajax({
            url: PAYMENT,
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
                swal("Error", errorMsg, "error");
                $("#payment_btn").attr('disabled', false);
            }
        });
    }

    const failedFunction = function(transaction_id) {
        swal("Transaction Failed",'Failed',"error");
    }

    const successFunction = function(transaction_id) {
        swal("Transaction completed",'success',"success");
    }

    const closedFunction = function() {
        swal("Closed",'Failed',"error");
    }

    const PayWithVoguePay = function(amount,description) {
        Voguepay.init({
            v_merchant_id: '6162-0064824',
            total: amount,
            // notify_url:'http://domain.com/notification.php',
            cur: 'USD',
            memo: description,
            recurrent: false,
            frequency: 10,
            
            closed:closedFunction,
            success:successFunction,
            failed:failedFunction
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

                swal({
                    title: "Are you sure?",
                    text: "You are about to pay for an investment",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function() {
                    PayWithVoguePay(amount,description);
                });   
            });


            $("input[type=image][name=SubscribeWithVoguePay]").on("click", function() {
                let description = $("#payment_description").val();
                let amount = $("#amount").val();

                swal({
                    title: "Are you sure?",
                    text: "You are about to pay for an investment",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function() {
                    PayWithVoguePay(amount,description);
                });   
            });

        }
    }

}();

jQuery(document).ready(function() {
    AppServiceSubscription.init();
});