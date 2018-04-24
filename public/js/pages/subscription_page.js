var AppServiceSubscription = function() {
    
    var loadServices = function() {
        $("#service_page").show();
        $("#select_packages").hide();
    }

    var selectPlatform = function(id, type) {
        
        if(type == 1) {
            toastr.info("Sorry, not available");
        }

        if(type == 0) {
            toastr.info("You selected Daily Signal!");
            $.ajax({
                url: DS_URL,
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
        
    }

    var processPayment = function(type,amount) {
        $.ajax({
            url: PAYMENT,
            method: "POST",
            data: {
                'id': type,
                'amount': amount,
                '_token': TOKEN
            },
            success: function(data) {
                swal("Successful!",data.msg,"success");
                setTimeout(() => {
                    window.location.replace("/dashboard");
                }, 3000);
            },
            error: function(alaxB, HTTerror, errorMsg) {
                swal("Error",errorMsg,"error");
            }
        });
    }

    return {
        init: function() {
            
            loadServices();
            
            $('body').find("#service_page .platform").each(function(index){
                $("#select_platform_" + index).on("click", function(){
                    var type = $("#platform_type_" + index).val();
                    var id = $("#platform_id_" + index).val();
                    selectPlatform(id, type);
                });
            });

            $('body').find("#select_packages").on("click","#return_back", function() {
                $("#select_packages").hide();
                $("#service_page").fadeIn();
            });

            $('body').find("#select_packages").on("click","#payment_btn", function() {
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
                function(){
                    processPayment(id,amount);
                });
            });
        }
    }

}();

jQuery(document).ready(function() {
    AppServiceSubscription.init();
});