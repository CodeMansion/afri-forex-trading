<div class="package_types">           
    @php($index=0)       
    @foreach($package_types as $type)
    <div class="col-lg-3 col-md-4 col-xs-12 col-sm-12">
        <div class="price-column-container border-active">
            <div class="price-table-head <?php if($index==0){ echo "bg-red"; }elseif($index==1){ echo "bg-green"; }else{echo "bg-blue";} ?> ">
                <h2 class="no-margin">{{ $type->name }} </h2>
            </div>
            <div class="arrow-down <?php if($index==0){ echo "border-top-red"; }elseif($index==1){ echo "border-top-green"; }else{echo "border-top-blue";} ?>"></div>
            <div class="price-table-pricing">
                <h3>{{ number_format($type->percentage) }}<sup class="price-sign">%</sup></h3>
                <p>Return Percentage</p>
            </div>
            <div class="price-table-content">
                <div class="row mobile-padding">
                    <div class="col-xs-3 text-right mobile-padding"></div>
                    <div class="col-xs-9 text-left mobile-padding">Return  on investment</div>
                </div>
            </div>
            <div class="arrow-down arrow-grey"></div>
            <div class="price-table-footer">
                <input type="hidden" id="package_id{{ $index }}" value="{{ $package->id }}" />
                <input type="hidden" id="package_type_id{{ $index }}" value="{{ $type->id }}" />
                <button type="button" id="continue{{ $index }}" class="btn green btn-outline btn-lg sbold uppercase price-button">Select</button>
            </div>
        </div>
    </div>        
    @php($index++)
    @endforeach
</div>
<script>
    $(document).ready(function(){
        $("#loader").hide();
    });
</script>