@extends('members.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="icon-wallet"></i> My Withdrawal Request <small></small> 
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
            <li><span>My Withdrawals </span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Withdrawal Request  </span>
                <span class="caption-helper">Displaying list of your withdrawal requests  </span>                        
            </div>
            <div class="actions">

            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            @if(count($withdrawals) < 1)
                                <center><em>There are no withdrawal request</em></center> 
                            @else 
                                <table class="table table-bordered table-hover withdrawal" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>INITIAL BALANCE</th>
                                            <th>CHARGE</th>
                                            <th>AMOUNT</th>
                                            <th>TOTAL</th>
                                            <th>STATUS</th>
                                            <th>UPDATED</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($counter=1)
                                        @php($index=0)
                                        @foreach($withdrawals as $withdrawal)
                                            <tr>
                                                <td>#</td>
                                                <td>${{ number_format($withdrawal->initial_wallet_balance,'2') }}</td> 
                                                <td>${{ number_format($withdrawal->withdrawal_charge,'2') }}</td> 
                                                <td>${{ number_format($withdrawal->withdrawal_amount,'2') }}</td> 
                                                <td>${{ number_format($withdrawal->deducted_amount,'2') }}</td> 
                                                <td><span class="badge badge-{{ withdrawal_status($withdrawal->status,'class') }}">{{ withdrawal_status($withdrawal->status,'name') }}</span></td>
                                                <td>{{ $withdrawal->updated_at->diffForHumans() }}</td>                                  
                                            </tr>
                                        @php($counter++)
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
@section('modals')
    
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}"; 
    </script>
    <script src="{{ asset('js/pages/withdrawal.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
@endsection