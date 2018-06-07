@extends('members.partials.app')

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>DASHBOARD</small> 
        <span class="pull-right">
            <i class="fa fa-calendar"></i> <?php echo date('l, F d, Y', strtotime(now())); ?>
        </span>
    </h1>
    @include('members.dashboard.partials._service_notice')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Dashboard</span></li>
        </ul>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-circle btn-sm red" data-target="#make_withdrawal" data-toggle="modal"><i class="icon-wallet"></i> Make Withdrawal</button>
            <button type="button" class="btn btn-circle btn-sm yellow" data-target="#share_fund" data-toggle="modal"><i class="icon-handbag"></i> Share Fund</button>
            <a href="{{ URL::route('register') }}/{{ auth()->user()->username }}" target="_blank">
                <button type="button" class="btn btn-sm btn-circle green"><i class="icon-plus"></i> New Downline</button>
            </a>
            <a href="{{ URL::route('packageSub') }}">
                <button type="button" class="btn btn-sm btn-circle green"><i class="icon-wallet"></i> New Service</button>
            </a>
        </div>
    </div>
    @include('members.dashboard.partials._cards')

    <div class="row">
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('members.dashboard.partials._latest_earnings')
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('members.dashboard.partials._withdrawals')
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
    @include('members.dashboard.modals._make_withdrawal')
    @include('members.profile.modals._share_fund')
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var PLATFORM_URL = "{{URL::route('package')}}";
        var SUBSCRIBE = "{{URL::route('subscriptions.add')}}";
        var REFERRAL = "{{URL::route('referrals.add')}}";
        var MEMBERS = "{{ URL::route('loadMembers') }}";
        var DISPUTE = "{{ URL::route('loadDispute') }}";
        var EARNINGS = "{{ URL::route('loadEarnings') }}";
        var ACTIVITY = "{{ URL::route('loadActivityLogs') }}";
        var TRANSACTION = "{{ URL::route('loadTransactions') }}";
        var WITHDRAW = "{{ URL::route('makeWithdrawal') }}";
        var WITHDRAWAL = "{{ URL::route('loadWithdrawals') }}";
        var SHARE_FUND = "{{URL::route('users.sharefund')}}";
        var USERDETAILS = "{{URL::route('users.FundInfo')}}";
    </script>
    <script src="{{ asset('js/pages/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/charts-echarts.js') }}" type="text/javascript"></script>
@endsection