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
            <div class="actions">
                
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    @if(count($transactions) < 1)
                        <center><em>No Transactions found</em></center>
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
    </div>
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