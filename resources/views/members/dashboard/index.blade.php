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
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-circle btn-outline green dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-plus"></i>&nbsp;
                <span class="hidden-sm hidden-xs">Quick Actions&nbsp;</span>&nbsp;
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu" role="menu">                                   
                <li><a href="{{ URL::route('packageSub') }}"><i class="icon-note"></i>Add Service</a></li> <li><a href="{{ URL::route('register') }}/{{ auth()->user()->slug }}" target="_blank"><i class="icon-note"></i>Add new Member</a></li>
            </ul>
        </div>
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
        var TOKEN = "{{csrf_token()}}";
        var PLATFORM_URL = "{{URL::route('package')}}";
        var SUBSCRIBE = "{{URL::route('subscriptions.add')}}";
        var REFERRAL = "{{URL::route('referrals.add')}}";
        var MEMBERS = "{{ URL::route('loadMembers') }}";
        var TRANSACTION_ONE = "{{ URL::route('loadTransactionsOne') }}";
        var ACTIVITY_ONE = "{{ URL::route('loadActivityLogsOne') }}";
        var DISPUTE = "{{ URL::route('loadDispute') }}";
        var ACTIVITY = "{{ URL::route('loadActivityLogs') }}";
        var TRANSACTION = "{{ URL::route('loadTransactions') }}";
    </script>
    <script src="{{ asset('js/pages/dashboard.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
@endsection