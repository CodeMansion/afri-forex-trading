@extends('members.partials.app')

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>MY SERVICES</small> 
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
            <li><span>My Services</span></li>
        </ul>
    </div>

    <div class="row">
        @if(isset($subscription))
        <a href="{{ URL::route('subscriptions.index') }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span>{{ $subscription->platform->name }}</span>
                                <small class="font-green-sharp"></small>
                            </h3>
                            <h4>${{ number_format($subscription->amount,'2') }}</h4>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @if(isset($investment))
        <a href="{{ URL::route('investments.index') }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span>{{ $investment->platform->name }}</span>
                                <small class="font-green-sharp"></small>
                            </h3>
                            <h4>${{ number_format($investment->Package->investment_amount,'2') }}</h4>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @if(isset($referral))
        <a href="{{ URL::route('referrals.index') }}">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span>{{ $referral->platform->name }}</span>
                                <small class="font-green-sharp"></small>
                            </h3>
                            <h4>${{ number_format(0,'2') }}</h4>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endif
    </div>
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
@endsection