<div class="row">
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12"></div>
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12" style="border: 1px solid grey;padding:10px;">
        <center>
            <h1 style="text-align:center;">{{ strtoupper($referrer['name']) }}</h1>
            <h3 style="color:red;font-weight:600;">Subscription fee: ${{ number_format($referrer['price'],2) }}</h3><hr/>
            <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
            <input type="hidden" id="platform_id" value="{{ $referrer['id'] }}" />
            <button type="button" id="referral" class="btn btn-lg green">PROCEED </button>
            <button type="button" id="return_back" class="btn btn-lg red">CANCEL</button>
        </center>    
    </div>
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12"></div>
</div>

<script>
    $(document).ready(function(){
        $("#loader").hide();
    });
</script>
