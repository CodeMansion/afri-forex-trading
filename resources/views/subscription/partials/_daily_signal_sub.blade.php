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
            <button type="button" id="payment_btn" class="btn btn-lg green">PROCEED TO PAYMENT</button>
            <button type="button" id="return_back" class="btn btn-lg red">CANCEL</button>
        </center> 
    </div>   
    </div>
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12"></div>
</div>

<script>
    $(document).ready(function(){
        $("#loader").hide();
    });
</script>
