@extends('members.partials.app')

@section('content')
    <h1 class="page-title"> Member Dashboard <small>statistics, charts, recent events and reports</small> </h1>
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
        <div class="col-md-12">
            <h1>Hello i am a member</h1>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ asset('assets/pages/scripts/charts-flotcharts.min.js') }}" type="text/javascript"></script> -->
@endsection
@section('after_script')
    <script src="{{ asset('js/pages/dashboard_chart.js') }}" type="text/javascript"></script>
@endsection
