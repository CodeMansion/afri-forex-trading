@extends('admin.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-users"></i> Members Page <small></small> 
        <span class="pull-right">
            <i class="fa fa-calendar"></i> <?php echo date('l, F d, Y', strtotime(now())); ?>
        </span>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Members Page</span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Members </span>
                <span class="caption-helper">Displaying list of registered Members</span>                        
            </div>
            <div class="actions">
                
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div id="serverErrors"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                @if(count($members) < 1)
                                    <center><em>There are no members</em></center> 
                                @else 
                                    <table class="table table-bordered table-hover users" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NAME</th> 
                                                <th>EMAIL</th>
                                                <th>USERNAME</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($index=0)
                                            @foreach($members as $member)
                                                <tr>
                                                    <td>#</td>
                                                    <td>{{ $member->full_name}} </td>
                                                    <td>{{ $member->email}} </td>
                                                    <td>{{ $member->username}}</td>
                                                    <td><span class="badge badge-{{ member_status($member->is_active,'class') }}">{{ member_status($member->is_active,'name') }}</span></td>
                                                    <td><a href="{{ URL::route('showMember', $member->slug) }}"><i class="icon-note"></i> Manage</a></td>
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
    </div>
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var UPDATE_URL = "{{URL::route('users.update')}}";
        var GET_EDIT_INFO = "{{URL::route('users.editInfo')}}";
        var ADDPLATFORM = "{{URL::route('users.add')}}";
    </script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('assets/pages/admin/user.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
