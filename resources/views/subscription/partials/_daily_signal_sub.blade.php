<div class="row">
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12"></div>
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12" style="border: 1px solid grey;padding:10px;">
    <div class="alert alert-success">
        <center>
            <h1 style="text-align:center;color:black;">{{ strtoupper($daily_signal['name']) }}</h1>
            <h3 style="color:red;font-weight:600;">Subscription fee: ${{ number_format($daily_signal['price'],2) }}</h3><hr/>
            <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
            <input type="hidden" id="platform_id" value="{{ $daily_signal['id'] }}" />
            <input type="hidden" id="amount" value="{{ $daily_signal['price'] }}" />
            <button type="button" id="payment_btn_stack" class="btn btn-lg green">PAY WITH PAYSTACK </button>
            {{-- <div id="paypal-button-container"></div> --}}
            <button type="button" id="payment_btn_pal" class="btn btn-lg info"></button>
            <button type="button" id="return_back" class="btn btn-lg red">CANCEL</button>
        </center> 
    </div>   
    </div>
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12"></div>
</div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    $(document).ready(function(){
        $("#loader").hide();
        var payWithPaypal = function(id, amount) {
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
                        processPayment(id, amount);
                        //window.alert('Payment Complete!');
                    });
                }

            }, '#payment_btn_pal');

        }
        payWithPaypal($("#platform_id").val(), $("#amount").val());
    });
</script>
