<div class="row">
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12"></div>
    <div class="col-lg-4 col-md-6 col-xs-12 col-sm-12" style="border: 1px solid grey;padding:10px;">
    <div class="alert alert-info">
        <center>
            <h1 style="text-align:center;">{{ strtoupper($investment['name']) }}</h1>
            <h3 style="color:red;font-weight:600;">Subscription fee: ${{ number_format($package->investment_amount,2) }}</h3>
            <h5 style="font-weight:600;">Return On Investment: {{ $type['percentage'] }}%</h5><hr/>
            <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
            <input type="hidden" id="platform_id" value="{{ $investment->id }}" />
            <input type="hidden" id="package_id" value="{{ $package->id }}" />
            <input type="hidden" id="package_type_id" value="{{ $type->id }}" />
            <button type="button" id="invest" class="btn btn-lg green">PROCEED TO PAYMENT</button>
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
