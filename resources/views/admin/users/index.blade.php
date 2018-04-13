@extends('admin.partials.app')

@section('content')
    <h1 class="page-title"> Admin Users <small>statistics, charts, recent events and reports</small> </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{ URL::route('dashboard') }} ">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Users</span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Users </span>
                <span class="caption-helper">Displaying list of users </span>                        
            </div>
            <div class="actions">
                <div class="btn-group">
                    <!--a class="font-white btn green pull pull-left" data-toggle="modal" data-target="#new-platform" title="Add"><i class="i"></i> Create New Platform</a-->
                    {{-- <a class="btn green-haze btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                        <i class="fa fa-angle-down"></i>
                    </a> --}}
                    <ul class="dropdown-menu pull-right">
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div id="serverErrors"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="purchases">
                                @if(count($users) < 1)
                                    <div class="danger-alert">
                                        <i class="fa fa-warning"></i> <em>There are no user available currently.</em>
                                    </div>
                                @else 
                                    <table class="table table-striped table-hover users" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th> 
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Telephone</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($counter=1)
                                            @php($index=0)
                                            @forelse($users as $user)
                                                <tr>
                                                    <td>{{ $counter++}}</td>
                                                    <td>{{ $user->full_name}} </td>
                                                    <td>{{ $user->email}} </td>
                                                    <td>{{ $user->username}}</td>
                                                    <td></td>
                                                    <td>
                                                        @if($user->is_active == true)
                                                                <a href="#" data-href="{{ URL::route('users.activate', $user->id) }}" id="remarks{{$index}}" class="label label-success btn-sm"><i class="fa fa-minus-square-o"></i>Active</a>
                                                        @else
                                                            <a href="#" data-href="{{ URL::route('users.activate', $user->id) }}" id="remarks{{$index}}" class="label label-danger btn-sm"><i class="fa fa-minus-square-o"></i>Not Active</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu pull-left" role="menu">
                                                                <input type="hidden" id="user_id{{$index}}" value="{{$user->slug}}">
                                                                <li><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i></a></li>
                                                                <li><a data-href="{{ URL::route('users.delete',$user->slug)}}" id="btn_user_delete{{$index}}"><i class="fa fa-trash"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php($index++)
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

@section('modals')
    @include('admin.users.modals._new_users')
    @include('admin.users.modals._edit_users')
@endsection
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var UPDATE_URL = "{{URL::route('users.update')}}";
        var GET_EDIT_INFO = "{{URL::route('users.editInfo')}}";
        var ADDPLATFORM = "{{URL::route('users.add')}}";
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" ="text/javascript"></script>
    
    <script src="{{ asset('assets/pages/admin/user.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection
