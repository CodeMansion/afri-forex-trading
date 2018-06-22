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
            <li><span>Payment Checkout</span></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="portlet light " id="form_wizard_1">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red bold uppercase"> Payment Page
                            <span class="step-title"></span>
                        </span>
                    </div>
                    <div class="actions">
                        <a href="{{ URL::route('packageSub') }}"><button class="btn btn-xs red" type="button"><i class="fa fa-close"></i> Cancel</button></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12"></div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                            <p style="font-size: 30px;color:#7F8C8D;text-align: center;">Welcome to our payment page. Please contact your UPLINE or COUNTRY REP to fund your wallet.</p><hr/>
                            <div class="portlet green-meadow box">
                                @if(isset($type) && $type == 1)
                                    @include('subscription.partials._daily_signal_sub')
                                @endif
                                @if(isset($type) && $type == 2)
                                    @include('subscription.partials._investment_sub')
                                @endif
                                @if(isset($type) && $type == 3)
                                    @include('subscription.partials._referral_sub')
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12"></div>
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
        var pay_with_wallet = "{{ URL::route('PayWithWallet') }}";
        var PAYMENT = "{{ URL::route('processPayment', 'ajax') }}";
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="https://voguepay.com/js/voguepay.js"></script>
    <script src="{{ asset('js/pages/subscription_page.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
@endsection