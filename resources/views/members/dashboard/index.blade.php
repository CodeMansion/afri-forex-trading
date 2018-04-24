@extends('members.partials.app')

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
            <li><span>Dashboard</span></li>
        </ul>
    </div>
    @include('members.dashboard.partials._cards')

    <!-- <div class="clearfix"></div> -->
    <div class="row">
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('members.dashboard.partials._latest_news')
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._activity_logs')
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._transactions')
        </div>
    </div>
    <div class="clearfix"></div>
    @include('members.modals.platform')
</div>
@endsection
@section('modals')
@endsection
@section('extra_script')
    <script>
        var subscription_count = "{{ $subscription }}";
        var investment_count   = "{{ $investment }}";
        var referral_count  = "{{ $referrals }}";
        var TOKEN = "{{csrf_token()}}";
        var PLATFORM_URL = "{{URL::route('package')}}";
        var SUBSCRIBE = "{{URL::route('subscriptions.add')}}";
        var REFERRAL = "{{URL::route('referrals.add')}}";
        var MEMBERS = "{{ URL::route('loadMembers') }}";
        var TRANSACTION_ONE = "{{ URL::route('loadTransactionsOne') }}";
        var ACTIVITY_ONE = "{{ URL::route('loadActivityLogsOne') }}";
    </script>
    <script src="{{ asset('js/pages/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" ="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/members/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/dashboard_chart.js') }}" type="text/javascript"></script>
@endsection