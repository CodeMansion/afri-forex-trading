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
        <div class="col-lg-8 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._revenue_chart')
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._support')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._new_members')
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._activity_logs')
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-12">
            @include('admin.dashboard.partials._transactions')
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ asset('assets/pages/scripts/charts-flotcharts.min.js') }}" type="text/javascript"></script> -->
@endsection
@section('after_script')
    <script>
        var DISPUTE = "{{ URL::route('loadDispute') }}";
        var MEMBERS = "{{ URL::route('loadMembers') }}";
        var TRANSACTION = "{{ URL::route('loadTransactions') }}";
        var CHART = "{{ URL::route('loadChart') }}";
        var ACTIVITY = "{{ URL::route('loadActivityLogs') }}";
    </script>
    <script src="{{ asset('js/pages/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/dashboard_chart.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
@endsection
