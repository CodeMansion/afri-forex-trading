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
                                <table class="table table-striped table-hover activitylogs" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Platform</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($counter=1)
                                        @forelse($downlines as $down)
                                            <tr>
                                                <td>{{ $counter++}}</td>
                                                <td><span class="label label-sm label-success">{{ $down->Platform->name}}</span></td>
                                                <td>{{ $down->User->username}} </td>                                                    
                                                <td>{{ $down->User->full_name}}</td> 
                                                <td>{{ $down->User->Profile->email}} </td> 
                                                <td>{{ $down->User->Profile->telephone}} </td>  
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
        </div>
    </div>
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
