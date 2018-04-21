@extends('members.partials.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1 class="page-title"> Member Dashboard</h1>
        </div>
        <div class="col-md-4">
            <div class="display">
                <div class="number">
                    <center>
                        <h1 class="font-red-haze">
                            <small>Account Balance</small><br />
                            <small class="font-green-sharp">$</small>
                            <span data-counter="counterup" data-value="20.00"></span>
                        </h1>
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <ul class="pagination">
            <li><i id="dp-calendar" class="glyphicon glyphicon-calendar"></i><?php $Today = date('y:m:d'); $new = date('l, F d, Y', strtotime($Today)); echo $new; ?></li>
            </ul>
        </div>
    </div>
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
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="7800">7.00</span>
                            <small class="font-green-sharp">$</small>
                        </h3>
                        <small>RECENT CREDIT</small>
                    </div>
                    <div class="icon">
                        <i class="icon-pie-chart"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                            <span class="sr-only">20% progress</span>
                        </span>
                    </div>
                <div class="status">
                    <div class="status-title"> progress </div>
                        <div class="status-number"> 20% </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-red-haze">
                            <small class="font-green-sharp">$</small>
                            <span data-counter="counterup" data-value="20.00"></span>
                        </h3>
                        <small>RECENT DEBIT</small>
                    </div>
                    <div class="icon">
                        <i class="icon-like"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                            <span class="sr-only">85% change</span>
                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> change </div>
                        <div class="status-number"> 85% </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-blue-sharp">
                            <small class="font-green-sharp">$</small>
                            <span data-counter="counterup" data-value="567">567</span>
                        </h3>
                        <small>WALLET</small>
                    </div>
                    <div class="icon">
                        <i class="icon-basket"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                            <span class="sr-only">45% grow</span>
                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> grow </div>
                        <div class="status-number"> 45% </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="clearfix"></div> -->
    <div class="row">
        <div class="col-md-4">
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Recent Activity</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="mt-element-list">
                        <div class="mt-list-container list-default ext-1">
                            <div class="mt-list-title uppercase">My List</div>
                            <ul>
                                @forelse($activities as $activity)
                                    <li class="mt-list-item done">
                                    <div class="list-icon-container">
                                        <a href="javascript:;">
                                            <i class="icon-check"></i>
                                        </a>
                                    </div>
                                    <div class="list-datetime"> 
                                        {{ $activity->created_at->diffForHumans() }}</div>
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">{{ $activity->ip }}</a>
                                        </h3>
                                        <p>{{ $activity->action }}</p>
                                    </div>
                                </li>
                                @empty
                                    <h4>No Recent Activity</h4>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Recent Support Ticket </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="mt-element-list">
                        <div class="mt-list-container list-default ext-1">
                            <div class="mt-list-title uppercase">My List</div>
                            <ul>
                                @forelse($supports as $support)
                                    <li class="mt-list-item done">
                                    <div class="list-icon-container">
                                        <a href="javascript:;">
                                            <i class="icon-check"></i>
                                        </a>
                                    </div>
                                    <div class="list-datetime"> 
                                        {{ $support->created_at->diffForHumans() }}</div>
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">{{ $support->ticket_no }}</a>
                                        </h3>
                                        <p>{{ $trans->message }}</p>
                                    </div>
                                </li>
                                @empty
                                    <h4>No Support Message Available</h4>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Recent Transactions </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="mt-element-list">
                        <div class="mt-list-container list-default ext-1">
                            <div class="mt-list-title uppercase">My List</div>
                            <ul>
                                @forelse($transactions as $trans)
                                <li class="mt-list-item done">
                                    <div class="list-icon-container">
                                        <a href="javascript:;">
                                            <i class="icon-check"></i>
                                        </a>
                                    </div>
                                    <div class="list-datetime"> 
                                        {{ $trans->created_at->diffForHumans() }}</div>
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">{{ $trans->amount }}</a>
                                        </h3>
                                        <p>{{ $trans->reference_no }}</p>
                                    </div>
                                </li>
                                @empty
                                    <h4>No Transactions Available</h4>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- @include('members.modals.platform') -->
</div>
@endsection
@section('modals')
    @include('members.modals._new_registration')
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
    </script>
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ asset('assets/pages/scripts/charts-flotcharts.min.js') }}" type="text/javascript"></script> -->
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" ="text/javascript"></script>

@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/members/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/dashboard_chart.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection