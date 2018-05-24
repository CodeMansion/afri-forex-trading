@extends('members.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>MY EARNINGS</small> 
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
            <li><span>My Earnings</span></li>
        </ul>
    </div>

    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">My Earnings History</span>
                <span class="caption-helper">Displaying list of all your earnings </span>                        
            </div>
            <div class="actions"></div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    @if(count($earnings) < 1)
                        <center><em>No earnings record found</em></center>
                    @else 
                    <table class="table table-bordered table-hover" id="sample_2">
                        <thead>
                            <tr>
                                <th width="30">S/N</th>
                                <!-- <th>PACKAGE</th> -->
                                <th width="50">TYPE</th>
                                <th>SERVICE</th>
                                <th width="90">AMOUNT</th>  
                                <th width="50">STATUS</th> 
                                <th>DATE</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @php($counter=1)
                            @foreach($earnings as $earning)
                            <tr>
                                <td>#</td>
                                <td>{{ $earning->type->name }}</td>
                                <td><span class="badge badge-success"> {{ $earning->platform->name }} </span> </td>
                                <td>${{ number_format($earning->amount,2) }}</td>
                                <td><span class="badge badge-{{ earnings_status($earning->status,'class') }}">{{ earnings_status($earning->status,'name') }}</span></td>
                                <td>{{ $earning->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_script')    
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
@endsection
