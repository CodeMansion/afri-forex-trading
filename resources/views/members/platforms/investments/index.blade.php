@extends('members.partials.app')

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>MY INVESTMENTS</small> 
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
            <li><span>Investments</span></li>
        </ul>
    </div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Investments</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1_1" data-toggle="tab">Investments </a></li>
                                <li> <a href="#tab_1_3" data-toggle="tab">Investment Downlines </a></li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_1">
                                    <div class="table">
                                        @if(count($investments) < 1)
                                            <div class="danger-alert">
                                                <i class="fa fa-warning"></i> <em>There are no Investment available currently. Please subscibe to a investment service.</em>
                                            </div>
                                        @else 
                                        <table class="table table-striped table-hover" id="sample_2">
                                            <thead>
                                                <tr>
                                                    <th> S/No. </th>
                                                    <th> Package </th>
                                                    <th> Package Type </th>
                                                    <th> Earnings </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php($counter=1)
                                                @foreach($investments as $investment)
                                                    <tr>
                                                        <td>{{ $counter++}}</td>
                                                        <td>{{ $investment->Package->name}} </td>                      
                                                        <td>{{ $investment->PackageType->name}}</td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_1_3">
                                    <div class="table">
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
                        </div>
                    </div>
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
    <script src="{{ asset('js/pages/investment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection