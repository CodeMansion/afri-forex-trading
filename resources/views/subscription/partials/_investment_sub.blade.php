<div class="row">
    @php($index=0)
    @foreach($packages as $package)
    <div class="all_packages">
        <div class="col-lg-2 col-md-4 col-xs-12 col-sm-12">
            <div class="price-column-container border-active" style="margin-bottom:10px;">
                <div class="price-table-head bg-green">
                    <h2 class="no-margin">{{ $package->name }} </h2>
                </div>
                <div class="arrow-down border-top-default"></div>
                <div class="price-table-pricing">
                    <h4 style="font-size:30px;">${{ number_format($package->investment_amount,2) }}</h4>
                    <p>Subscription Fee</p>
                </div>
                <div class="price-table-content">
                    <div class="">
                        <center>CHARGES: {{ $package->monthly_charge }}%</center>
                    </div>
                </div>
                <div class="arrow-down arrow-grey"></div>
                <div class="price-table-footer">
                    <input type="hidden" id="platform_id" value="{{ $investment->id }}" />
                    <input type="hidden" id="package_id_{{ $index }}" value="{{ $package->id }}" />
                    <button type="button" id="package_type_{{$index}}" class="btn green btn-outline btn-lg sbold uppercase price-button">Select</button>
                </div>
            </div>
        </div>
    </div>
    @php($index++)
    @endforeach
</div>
<script>
    $(document).ready(function(){
        $('body').find("#select_packages .all_packages").each(function(index) {
            $("#package_type_" + index).on("click", function() {
                var package_id = $("#package_id_" + index).val();
                $.ajax({
                        url: GET_TYPES,
                        method: "POST",
                        data: {
                            'package_id': package_id,
                            '_token': TOKEN
                        },
                        success: function(data) {
                            $('body').find("#select_packages").hide();
                            $('body').find("#select_package_types").fadeIn();
                            $('body').find("#select_package_types").html(data);
                        },
                        error: function(alaxB, HTTerror, errorMsg) {
                            toastr.error(errorMsg);
                        }
                    });
                
            });
        });
    });
</script>