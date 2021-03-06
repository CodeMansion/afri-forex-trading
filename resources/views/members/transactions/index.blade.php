@extends('members.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>MY TRANSACTIONS</small> 
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
            <li><span>My Transactions</span></li>
        </ul>
    </div>

    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">My Recent Transactions </span>
                <span class="caption-helper">Displaying list of Transactions </span>                        
            </div>
            <div class="actions"></div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    @if(count($transactions) < 1)
                        <center><em>No Transactions found</em></center>
                    @else 
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="30">S/N</th>
                                <th>REFRENCE NO</th>
                                <th width="50">TYPE</th>
                                <th>SERVICE</th>
                                <th width="90">AMOUNT</th>  
                                <th>DATE</th>                             
                            </tr>
                        </thead>
                        <tbody>
                            @php($counter=1)
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{$counter}}</td>
                                <td>{{ $transaction->reference_no }}</td>
                                <td><span class="badge badge-success"> {{ $transaction->Category->name }} </span> </td>
                                <td>
                                    @if(isset($transaction->Platform->name))
                                        <span class="badge badge-default">{{ $transaction->Platform->name }}</span>
                                    @else   
                                        <span class="badge badge-warning">Transfer</span>
                                    @endif
                                </td>
                                <td>${{ number_format($transaction->amount,2) }}</td>
                                <td>{{ $transaction->created_at }}</td>
                            </tr>
                            @php($counter++)
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
