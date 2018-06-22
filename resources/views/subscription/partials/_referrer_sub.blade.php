<div class="portlet-title">
    <div class="caption"><i class="fa fa-cogs"></i>Referral Service Summary </div>
</div>
<div class="portlet-body">
    <div class="row static-info">
        <div class="col-md-5 name"> Service: </div>
        <div class="col-md-7 value"> {{ strtoupper($platform->name) }}</div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Investment Amount: </div>
        <div class="col-md-7 value">
            ${{ number_format($platform->price,2) }}
        </div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Return On Investment: </div>
        <div class="col-md-7 value"> Downline Commission </div>
    </div><hr/>
    <center>
        <button class="btn btn-lg green" type="button" id="ConfirmReferral">Proceed</button>
    </center>
</div>