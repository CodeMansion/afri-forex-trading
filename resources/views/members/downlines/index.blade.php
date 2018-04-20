@extends('members.partials.app')

@section('content')
    {{-- <h1 class="page-title"> Admin Downlines <small>statistics, charts, recent events and reports</small> </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{ URL::route('dashboard') }} ">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Downlines</span></li>
        </ul>
    </div>
    <div class="clearfix"></div> --}}
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
            <div id="serverErrors"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="purchases">
                                @if(count($downlines) < 1)
                                    <div class="danger-alert">
                                        <i class="fa fa-warning"></i> <em>There are no Downlines available currently. </em>
                                    </div>
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
                                                     <td><span class="label label-sm label-success">{{ $down->Profile->Platform->name}}</span></td>
                                                    <td>{{ $down->Profile->User->username}}</td>
                                                    <td>{{ $down->Profile->full_name}} </td> 
                                                    <td>{{ $down->Profile->email}} </td> 
                                                    <td>{{ $down->Profile->telephone}} </td>  
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
