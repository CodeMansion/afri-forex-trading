<div class="row">
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12"></div>
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12" style="">
    <div class="">
        <center>
            <h1 style="text-align:center;">{{ strtoupper($investment['name']) }}</h1>
            <h3 style="color:red;font-weight:600;">Subscription fee: ${{ number_format($package->investment_amount,2) }}</h3>
            <h5 style="font-weight:600;">Return On Investment: {{ $type['percentage'] }}%</h5><hr/>
            <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
            <input type="hidden" id="platform_id" value="{{ $investment->id }}" />
            <input type="hidden" id="package_id" value="{{ $package->id }}" />
            <input type="hidden" id="package_type_id" value="{{ $type->id }}" />
            <input type="hidden" id="amount" value="{{ $package->investment_amount }}" />
            <button type="button" id="invest" class="btn btn-md green">PAY WITH PAYSTACK</button>
            <button type="button" id="payment_btn_pal" class="btn btn-sm info"></button>
        </center>    
    </div>
    </div>
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12"></div>
</div>

<script>
    $(document).ready(function(){
        $("#loader").hide();
        var payWithPaypal = function(platform_id, package_id, package_type_id, amount) {
            paypal.Button.render({
                env: 'sandbox', // sandbox | production
                style: {
                    label: 'pay',
                    size: 'small', // small | medium | large | responsive
                    shape: 'rect', // pill | rect
                    color: 'blue' // gold | blue | silver | black
                },
                // PayPal Client IDs - replace with your own
                // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                client: {
                    sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                    production: '<insert production client id>'
                },
                // Show the buyer a 'Pay Now' button in the checkout flow
                commit: true,
                // payment() is called when the button is clicked
                payment: function(data, actions) {

                    // Make a call to the REST api to create the payment
                    return actions.payment.create({
                        payment: {
                            transactions: [{
                                amount: { total: amount, currency: 'USD' }
                            }]
                        }
                    });
                },
                // onAuthorize() is called when the buyer approves the payment
                onAuthorize: function(data, actions) {
                    // Make a call to the REST api to execute the payment
                    return actions.payment.execute().then(function() {
                        Invest(platform_id, package_id, package_type_id);
                        //window.alert('Payment Complete!');
                    });
                }

            }, '#payment_btn_pal');

        }
        payWithPaypal($("#platform_id").val(), $("#package_id").val(), $("#package_type_id").val(), $("#amount").val());
    });
</script>
