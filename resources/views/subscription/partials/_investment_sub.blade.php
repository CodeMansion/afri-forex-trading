<div class="portlet-title">
    <div class="caption"><i class="fa fa-cogs"></i>Investment Summary </div>
</div>
<div class="portlet-body">
    <div class="row static-info">
        <div class="col-md-5 name"> Service: </div>
        <div class="col-md-7 value"> {{ strtoupper($platform->name) }}</div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Service Type: </div>
        <div class="col-md-7 value"> {{ strtoupper($package->name) }} </div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Investment Amount: </div>
        <div class="col-md-7 value">
            ${{ number_format($package->investment_amount,2) }}
        </div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Monthly Charges: </div>
        <div class="col-md-7 value"> {{ $package->monthly_charge }}% </div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Earning Type: </div>
        <div class="col-md-7 value"> {{ strtoupper($package_type->name) }} </div>
    </div>
    <div class="row static-info">
        <div class="col-md-5 name"> Earning Amount </div>
        <div class="col-md-7 value"> ${{ number_format($package->earnings,2) }}</div>
    </div><hr/>
    <center>
        <input type="hidden" id="invest_amount" value="{{ $package->investment_amount }}" />
        <input type="hidden" id="invest_payment_description" value="Payment for investment" />
        <input type="hidden" id="package_id" value="{{ $package->id }}" />
        <input type="hidden" id="package_type_id" value="{{ $package_type->id }}" />
        <input type='image' name="InvestWithVoguePay" src='https://voguepay.com/images/buttons/make_payment_blue.png' alt='pay-with-voguepay' /><br/>
        <!-- @if(isset($balance->amount) && $balance->amount > 10.00) -->
        <button class="btn btn-lg green" type="button" id="PayWithWalletInvest"><i class="icon-wallet"></i> Pay With Wallet</button>
        <!-- @endif -->
    </center>
</div>