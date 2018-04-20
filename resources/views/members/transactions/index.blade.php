@extends('members.partials.app')

@section('content')
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="{{ ($credit) ? $credit->amount : 0 }}">7.00</span>
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
                        <span data-counter="counterup" data-value="{{ ($debit) ? $debit->amount : 0 }}">10.00</span>
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
{{-- <div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart theme-font hide"></i>
            <span class="caption-subject font-blue-madison bold uppercase">Transactions</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row number-stats margin-bottom-30">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="stat-left">
                    <div class="stat-chart">
                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                        <div id="sparkline_bar"><canvas width="90" height="45" style="display: inline-block; width: 90px; height: 45px; vertical-align: top;"></canvas></div>
                    </div>
                    <div class="stat-number">
                        <div class="title"> Total Credit Transactions</div>
                        <div class="number"> 2460 </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="stat-right">
                    <div class="stat-chart">
                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                        <div id="sparkline_bar2"><canvas width="90" height="45" style="display: inline-block; width: 90px; height: 45px; vertical-align: top;"></canvas></div>
                    </div>
                    <div class="stat-number">
                        <div class="title"> Total Debit Transactions </div>
                        <div class="number"> 719 </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-comments"></i>All Transactions</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    @if(count($transactions) < 1)
                        <div class="danger-alert">
                            <i class="fa fa-warning"></i> <em>There are no Transactions available currently. </em>
                        </div>
                    @else 
                    <table class="table table-striped table-hover" id="sample_2">
                        <thead>
                            <tr>
                                <th> S/No. </th>
                                <th> Reference No. </th>
                                <th> Category </th>
                                <th> Platform </th>
                                <th> Amount </th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @php($counter=1)
                            @forelse($transactions as $trans)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{ $trans->reference_no }}</td>
                                <td> <span class="label label-sm label-success"> {{ $trans->Category->name }} </span> </td>
                                <td> {{ $trans->Platform->name }} </td>
                                <td> {{ $trans->amount }} </td>
                                <td>
                                    
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
    
    <script src="{{ asset('assets/pages/admin/transactioncategories.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection