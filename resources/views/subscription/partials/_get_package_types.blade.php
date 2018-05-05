@php($index=0)
    @foreach($package_types as $type)
    <div class="package_types">
        <div class="col-lg-3 col-md-4 col-xs-12 col-sm-12">
            <div class="price-column-container border-active">
                <div class="price-table-head <?php if($index==0){ echo "bg-red"; }elseif($index==1){ echo "bg-green"; }else{echo "bg-blue";} ?> ">
                    <h2 class="no-margin">{{ $type->name }} </h2>
                </div>
                <div class="arrow-down <?php if($index==0){ echo "border-top-red"; }elseif($index==1){ echo "border-top-green"; }else{echo "border-top-blue";} ?>"></div>
                <div class="price-table-pricing">
                    <h3>{{ number_format($type->percentage) }}%<sup class="price-sign"></sup></h3>
                    <p>Return Percentage</p>
                </div>
                <div class="arrow-down arrow-grey"></div>
                <div class="price-table-footer">
                    <input type="hidden" id="package_type_id{{ $index }}" value="{{ $type->id }}" />
                    <input type="hidden" id="package_id_" value="{{ $package_id }}" />
                    <button type="button" id="continue_{{ $index }}" class="btn green btn-outline btn-lg sbold uppercase price-button">Select</button>
                </div>
            </div>
        </div>
    @php($index++)
    </div>
    @endforeach

    <script>
        $(document).ready(function() {
            $('body').find("#select_package_types .package_types").each(function(index) {
                $("#continue_" + index).on("click", function() {
                    var platform_id = $("#select_packages").find("#platform_id").val();
                    var package_id = $("#package_id_").val();
                    var package_type_id = $("#package_type_id" + index).val();
                    toastr.info("Proceeding To Payment!");
                    $.ajax({
                        url: IN_PAYMENT_INFO_URL,
                        method: "POST",
                        data: {
                            'platform_id': platform_id,
                            'package_id': package_id,
                            'package_type_id': package_type_id,
                            '_token': TOKEN
                        },
                        success: function(data) {
                            $("#loader").hide();
                            $("#service_page").hide();
                            $("#select_package_types").hide();
                            $("#select_packages").hide();
                            $("#select_packages").fadeIn();
                            $("#select_packages").html(data);
                        },
                        error: function(alaxB, HTTerror, errorMsg) {
                            toastr.error(errorMsg);
                        }
                    });
                });
            })
        });
    </script>