@extends('admin.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="icon-wallet"></i> Payment Transactions <small></small> 
        <span class="pull-right">
            <i class="fa fa-calendar"></i> <?php echo date('l, F d, Y', strtotime(now())); ?>
        </span>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{ URL::route('dashboard') }} ">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Payment Transaction </span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Payment Transaction  </span>
                <span class="caption-helper">Displaying list of payment transactions  </span>                        
            </div>
            <div class="actions">
                
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="row">
                <div class="col-md-7 col-lg-7 col-xs-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            @if(count($transactions) < 1)
                                <center><em>There are no recent transactions</em></center> 
                            @else 
                                <table class="table table-bordered transaction" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($index=0)
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>#</td>
                                                <td>{{ $transaction->user->full_name}} </td>
                                                <td>{{ number_format($transaction->amount,'2') }}</td> 
                                                <td><span class="badge badge-success">{{ $transaction->Category->name }}</span></td>
                                                <td>{{ $transaction->created_at }}</td>                                                   
                                                <td><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i> View</a></td>  
                                                <td><a href="javascript:;" id="btn_transaction_delete{{$index}}"><i class="fa fa-trash"></i> Delete</a></td>
                                            </tr>
                                        @php($index++)
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}"; 
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
@endsection
