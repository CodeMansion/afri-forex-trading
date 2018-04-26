@extends('members.partials.app')

@section('content')
<h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>MY Referrals</small> 
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
            <li><span>Referrals</span></li>
        </ul>
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
        <div class="portlet light tasks-widget">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-green-haze bold uppercase">Downlines </span>
                    <span class="caption-helper">Displaying list of Downline </span>                        
                </div>
            </div>
            <div class="portlet-body downlines">
                <div class="table">
                    @if(count($downlines) < 1)
                        <div class="danger-alert">
                            <i class="fa fa-warning"></i> <em>There are no Downline available currently. Please Share Your Referral Link To Get Downlines.</em>
                        </div>
                    @else 
                    <table class="table table-striped table-hover" id="sample_2">
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
                            @foreach($downlines as $down)
                                <tr>
                                    <td>{{ $counter++}}</td>
                                    <td>{{ $down->User->username}} </td>                                                    
                                    <td>{{ $down->User->full_name}}</td>
                                    <td>
                                        @if($down->is_active == 1)
                                            <label class="label label-success btn-sm"> Active</label>
                                        @else
                                            <label class="label label-warning btn-sm"> Not Active</label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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