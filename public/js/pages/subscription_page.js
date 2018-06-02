var AppServiceSubscription = function() {

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

    

    const VoguePay = function() {
        Voguepay.init({
            v_merchant_id: '6162-0064824',
            total: price,
            notify_url:'http://domain.com/notification.php',
            cur: 'USD',
            merchant_ref: 'ref123',
            memo:'Payment for '+item,
            recurrent: true,
            frequency: 10,
            developer_code: '5a61be72ab323',
            store_id:1,
            
           closed:closedFunction,
           success:successFunction,
           failed:failedFunction
       });
    }

    return {
        init: function() {
           
        }
    }

}();

jQuery(document).ready(function() {
    AppServiceSubscription.init();
});