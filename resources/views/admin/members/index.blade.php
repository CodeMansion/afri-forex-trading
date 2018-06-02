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
                <a class="btn btn-sm green" data-toggle="modal" data-target="#new-admin-member"><i class="icon-plus"></i> New Administrator</a>
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div id="serverErrors"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="portlet-title tabbable-line">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#admin" data-toggle="tab">Administrators</a></li>
                                <li><a href="#members" data-toggle="tab">Members</a></li
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="admin">
                                    @include('admin.members.partials._administrators')
                                </div>
                                <div class="tab-pane" id="members">
                                    @include('admin.members.partials._members')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    @include('admin.members.modals._new_admin_member')
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var create_administrator = "{{URL::route('CreateNewAdmin')}}";
        var delete_member = "{{ URL::route('DeleteMember') }}";
    </script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/pages/all_users.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
