@extends('members.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/pages/css/pricing.min.css') }}" rel="stylesheet" type="text/css" />
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
            <li><span>Package Subscription</span></li>
        </ul>
    </div>

    <!-- <div class="clearfix"></div> -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="portlet light " id="form_wizard_1">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red bold uppercase"> Services
                            <span class="step-title"></span>
                        </span>
                    </div>
                    <div class="actions"></div>
                </div>
                <div class="portlet-body form">
                    <div class="pricing-content-1">
                        <div class="row">
                            <div id="service_page">
                                @php($counter=0)
                                @php($index=0)
                                @foreach($platforms as $platform)
                                <div class="platform">
                                    <div class="col-lg-3 col-md-4 col-xs-12 col-sm-12" id="service_{{ $index }}">
                                        <div class="price-column-container border-active">
                                            <div class="price-table-head <?php if($index==0){ echo "bg-red"; }elseif($index==1){ echo "bg-green"; }else{echo "bg-blue";} ?> ">
                                                <h2 class="no-margin">{{ $platform->name }} </h2>
                                            </div>
                                            <div class="arrow-down <?php if($index==0){ echo "border-top-red"; }elseif($index==1){ echo "border-top-green"; }else{echo "border-top-blue";} ?>"></div>
                                            <div class="price-table-pricing">
                                                <h3><sup class="price-sign">$</sup>{{ number_format($platform->price) }}</h3>
                                                <p>Subscription Fee</p>
                                            </div>
                                            <div class="price-table-content">
                                                <div class="row mobile-padding">
                                                    <div class="col-xs-3 text-right mobile-padding"><i class="icon-user"></i></div>
                                                    <div class="col-xs-9 text-left mobile-padding">{{ $platform->description }}</div>
                                                </div>
                                            </div>
                                            <div class="arrow-down arrow-grey"></div>
                                            <div class="price-table-footer">
                                                <input type="hidden" id="platform_id_{{ $index }}" value="{{ $platform->id }}" />
                                                <input type="hidden" id="platform_type_{{ $index }}" value="{{ $platform->is_multiple }}" />
                                                <button type="button" id="select_platform_{{ $index }}" class="btn green btn-outline btn-lg sbold uppercase price-button">Select</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php($index++)
                                @endforeach
                            </div>
                            <div id="select_packages">
                                
                            </div>
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
        var DS_URL = "{{URL::route('getDailySignalInfo')}}";
        var PAYMENT = "{{ URL::route('processPayment', 'ajax') }}";
        var REFERRAL = "{{URL::route('referrals.add')}}";
        var MEMBERS = "{{ URL::route('loadMembers') }}";
        var TRANSACTION_ONE = "{{ URL::route('loadTransactionsOne') }}";
        var ACTIVITY_ONE = "{{ URL::route('loadActivityLogsOne') }}";
    </script>
    
@endsection
@section('after_script')
    <script src="{{ asset('js/pages/subscription_page.js') }}" type="text/javascript"></script>
@endsection