@extends('admin.partials.app')

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Dashboard <small></small> 
        <span class="pull-right">
            <i class="fa fa-calendar"></i> <?php echo date('M d, Y', strtotime(now())); ?>
        </span>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Dashboard</span></li>
        </ul>
    </div>
    <div class="row">
        @include('admin.dashboard.partials._cards')
    </div>
    
    <div class="row">
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._new_members')
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._transactions')
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._support')
        </div>
        <!-- <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._activity_logs')
        </div> -->
    </div>
    <div class="clearfix"></div>
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script>
        var DISPUTE = "{{ URL::route('loadDispute') }}";
        var MEMBERS = "{{ URL::route('loadMembers') }}";
        var TRANSACTION = "{{ URL::route('loadTransactions') }}";
        var CHART = "{{ URL::route('loadChart') }}";
        var ACTIVITY = "{{ URL::route('loadActivityLogs') }}";
        var EARNINGS = "{{ URL::route('loadEarnings') }}";
        var WITHDRAW = "{{ URL::route('makeWithdrawal') }}";
    </script>
    <script src="{{ asset('js/pages/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/charts-echarts.js') }}" type="text/javascript"></script>
@endsection
