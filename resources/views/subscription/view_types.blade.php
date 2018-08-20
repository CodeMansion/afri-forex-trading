@extends('members.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/pages/css/pricing.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>DASHBOARD</small> 
        <span class="pull-right">
            <i class="fa fa-calendar"></i> <?php echo date('l, F d, Y', strtotime(now())); ?>
        </span>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ URL::route('packageSub') }}">
                    <span>Services</span>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
            <li>
                <a href="{{ URL::route('packageSub') }}">
                    <span>Packages</span>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
            <li><span>Package Type</span></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="portlet light " id="form_wizard_1">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red bold uppercase"> Investment Package Types
                            <span class="step-title"></span>
                        </span>
                    </div>
                    <div class="actions">
                    <a href="{{ URL::route('packageSub') }}"><button class="btn btn-xs red" type="button"><i class="fa fa-close"></i> Cancel</button></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="pricing-content-1">
                        <p style="font-size: 30px;color:#7F8C8D;text-align: center;">Please INVESTMENT earning type below to continue.</p><hr/>
                        <div class="row">
                            @php($index=0)
                            @foreach($types as $type)
                                <div class="col-lg-3 col-md-4 col-xs-12 col-sm-12"></div>
                                <div class="col-lg-3 col-md-4 col-xs-12 col-sm-12">
                                    <div class="price-column-container border-active">
                                        <div class="price-table-head <?php if($index==0){ echo "bg-red"; }elseif($index==1){ echo "bg-green"; }else{echo "bg-blue";} ?> ">
                                            <h2 class="no-margin">{{ $type->name }} </h2>
                                        </div>
                                        <div class="arrow-down <?php if($index==0){ echo "border-top-red"; }elseif($index==1){ echo "border-top-green"; }else{echo "border-top-blue";} ?>"></div>
                                        <div class="price-table-pricing">
                                            <h3>{{ number_format($type->percentage) }}%<sup class="price-sign"></sup></h3>
                                            <p>Return On Investment</p>
                                        </div>
                                        <div class="arrow-down arrow-grey"></div>
                                        <div class="price-table-footer">
                                            <a href="{{ URL::route('ViewPayment', ['package'=>$package->slug,'type'=>$type->id,'platform'=>2]) }}"><button type="button" class="btn green btn-outline btn-lg sbold uppercase price-button">Select</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-xs-12 col-sm-12"></div>
                            @php($index++)
                            @endforeach
                        </div>    
                    </div>       
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('js/pages/subscription_page.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
@endsection