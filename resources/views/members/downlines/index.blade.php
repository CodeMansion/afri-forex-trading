@extends('members.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>MY DOWNLINES</small> 
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
            <li><span>My Downlines</span></li>
        </ul>
    </div>

    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Downlines </span>
                <span class="caption-helper">Displaying list of Downlines </span>                        
            </div>
            <div class="actions">
                
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            @if(count($downlines) < 1)
                                <center><em>No Downline found </em></center> 
                            @else 
                                <table class="table table-bordered table-hover activitylogs" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th width="30">S/N</th>
                                            <th width="50"></th>
                                            <th>NAME</th>
                                            <th>USERNAME</th>
                                            <th>EMAIL</th>
                                            <th>PHONE</th>
                                            <th>SERVICE</th>
                                            <th>DOWNLINES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($counter=1)
                                        @foreach($downlines as $downline)
                                            <tr>
                                                <td>#</td>
                                                <td><img src="{{ asset('images/default.png') }}" width="30" height="30" /></td>
                                                <td>{{ strtoupper($downline->User->full_name) }} </td> 
                                                <td>{{ $downline->User->username}}</td>
                                                <td>{{ $downline->User->email}} </td> 
                                                <td>{{ $downline->User->Profile->telephone}} </td> 
                                                <td>
                                                    @if($downline->platform_id == null)
                                                    <span class="badge badge-warning">Not Active</span>
                                                    @else
                                                    <span class="badge badge-success">{{ $downline->Platform->name}}</span>
                                                    @endif
                                                </td>
                                                <td></td> 
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
@endsection
@section('extra_script')    
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
@endsection
