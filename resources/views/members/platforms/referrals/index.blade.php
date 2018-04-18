@extends('members.partials.app')

@section('content')
<div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-green-sharp">
                            <span data-counter="counterup" data-value="{{ ($earning) ? $earning->amount : 0 }}">7.00</span>
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
                            <span data-counter="counterup" data-value="{{ ($recent) ? $recent->amount : 0 }}">10.00</span>
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
                            <span data-counter="counterup" data-value="{{ ($wallet) ? $wallet->amount : 0 }}">567</span>
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
    
<!-- BEGIN PORTLET -->
<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase">Referral Platform</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-comments"></i>Referral Transactions</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    @if(count($transactions) < 1)
                        <div class="danger-alert">
                            <i class="fa fa-warning"></i> <em>There are no Transactions available currently.</em>
                        </div>
                    @else 
                    <table class="table table-striped table-hover" id="sample_3">
                        <thead>
                            <tr>
                                <th> S/No. </th>
                                <th> Reference No. </th>
                                <th> Category </th>
                                <th> Amount </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($counter=1)
                            @forelse($transactions as $tranc)
                                <tr>
                                    <td>{{ $counter++}}</td>
                                    <th>{{ $trac->reference_no }}</th>
                                    <th>
                                        <label class="label label-success btn-sm">{{ $trac->Category->name }}</label>
                                    </th>
                                    <th>{{ $trac->amount }}</th>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-comments"></i>Referral Downlines</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    @if(count($downlines) < 1)
                        <div class="danger-alert">
                            <i class="fa fa-warning"></i> <em>There are no Downline available currently. Please Share Your Referral Link To Get Downlines.</em>
                        </div>
                    @else 
                    <table class="table table-striped table-hover" id="sample_3">
                        <thead>
                            <tr>
                                <th> S/No. </th>
                                <th> FullName </th>
                                <th> Username </th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($counter=1)
                            @forelse($downlines as $down)
                                <tr>
                                    <td>{{ $counter++}}</td>
                                    <td>{{ $down->Profile->full_name}} </td>                                                    
                                    <td>{{ $down->Profile->User->username}}</td>
                                    <td>
                                        @if($down->is_active == 1)
                                            <label class="label label-success btn-sm"> Active</label>
                                        @else
                                            <label class="label label-warning btn-sm"> Not Active</label>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END PORTLET -->
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" ="text/javascript"></script>

@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection