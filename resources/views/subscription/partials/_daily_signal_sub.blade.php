<div class="portlet-title">
    <div class="caption"><i class="fa fa-cogs"></i>Subscription Summary </div>
</div>
<div class="portlet-body">
    <div class="row static-info">
        <div class="col-md-5 name"> Service: </div>
        <div class="col-md-7 value"> {{ strtoupper($platform->name) }}</div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Subscription Amount: </div>
        <div class="col-md-7 value">
            ${{ number_format($platform->price,2) }}
        </div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Subscription Type: </div>
        <div class="col-md-7 value"> First Time </div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Earning Type: </div>
        <div class="col-md-7 value"> Referral </div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Return On Investment: </div>
        <div class="col-md-7 value"> Daily Investment Tips </div>
    </div><hr/>
    <center>
        <input type="hidden" id="amount" value="{{ $platform->price }}" />
        <input type="hidden" id="payment_description" value="Daily Signal Subscription" />
        <input type='image' name="SubscribeWithVoguePay" src='https://voguepay.com/images/buttons/make_payment_blue.png' alt='pay-with-voguepay' /><br/>
        <!-- @if(isset($balance->amount) && $balance->amount > 10.00) -->
        <button class="btn btn-lg green" type="button" id="PayWithWallet" ><i class="icon-wallet"></i> Pay With Wallet</button>
        <!-- @endif -->
    </center>
</div>