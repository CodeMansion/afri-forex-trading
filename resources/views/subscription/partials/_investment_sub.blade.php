<div class="packages">
@php($index=0)
@foreach($packages as $package)
    <div class="col-lg-3 col-md-4 col-xs-12 col-sm-12">
        <div class="price-column-container border-active">
            <div class="price-table-head bg-green">
                <h2 class="no-margin">{{ $package->name }} </h2>
            </div>
            <div class="arrow-down border-top-default"></div>
            <div class="price-table-pricing">
                <h4 style="font-size:2.8em;"><sup class="price-sign">$</sup>{{ number_format($package->investment_amount,2) }}</h4>
                <p>Subscription Fee</p>
            </div>
            <div class="price-table-content">
                <div class="row mobile-padding">
                    <div class="col-xs-8 text-left mobile-padding">Monthly Charges</div>
                    <div class="col-xs-4 text-left mobile-padding">{{ $package->monthly_charge }}</div>
                </div>
            </div>
            <div class="arrow-down arrow-grey"></div>
            <div class="price-table-footer">
                <input type="hidden" id="platform_id" value="{{ $investment->id }}" />
                <input type="hidden" id="package_id{{ $index }}" value="{{ $package->id }}" />
                <button type="button" id="package_type" class="btn green btn-outline btn-lg sbold uppercase price-button">Select</button>
            </div>
        </div>
    </div>
@php($index++)
@endforeach
</div>
