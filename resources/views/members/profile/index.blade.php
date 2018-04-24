@extends('members.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>PERSONAL PROFILE</small> 
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
            <li><span>My Profile</span></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="profile-sidebar">
                <div class="portlet light profile-sidebar-portlet ">
                    <div class="profile-userpic">
                        <img src="{{ asset('images/avatar_default.jpg') }}" class="img-responsive" alt=""> 
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> {{ strtoupper(auth()->user()->full_name) }} </div>
                        <div class="profile-usertitle-job"> Member </div>
                    </div><hr/>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li><a href="#" data-target="#change_password" data-toggle="modal"><i class="icon-home"></i> Change Password </a></li>
                            <li class="" data-target="#change_picture" data-toggle="modal"><a href="#"><i class="icon-settings"></i> Change Picture </a></li>
                            <li><a href="#"><i class="icon-info"></i> Share Funds </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1_1" data-toggle="tab">Personal Info</a></li>
                                    <li> <a href="#tab_1_3" data-toggle="tab">Payment Account Info</a></li>
                                    <li><a href="#tab_1_4" data-toggle="tab">Activity Logs</a></li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form role="form" action="#">
                                            <div class="form-group">
                                                <label class="control-label">Full Name</label>
                                                <input type="text" placeholder="Full Name" id="full_name" value="{{ $profile['full_name'] }}" class="form-control" /> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Email Address</label>
                                                <input type="email" placeholder="Email Address" id="email" value="{{ $profile['email'] }}" class="form-control" disabled/> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Username</label>
                                                <input type="email" placeholder="Username" id="username" value="{{ $profile['username'] }}" class="form-control" /> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Telephone</label>
                                                <input type="text" placeholder="Telephone" id="telephone" value="{{ $profile['telephone'] }}" class="form-control" /> 
                                            </div><hr/>
                                            <div class="margiv-top-10">
                                                <a href="javascript:;" id="update_profile_btn" class="btn green" disabled> Save Changes </a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tab_1_3">
                                        <form role="form" action="#">
                                            <div class="form-group">
                                                <label class="control-label">Account Name</label>
                                                <input type="text" id="account_name" class="form-control"> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Account Username</label>
                                                <input type="text" id="account_username" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Account Email</label>
                                                <input type="email" id="account_email" class="form-control"> 
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Account Token</label>
                                                <input type="text" id="account_token" class="form-control"> 
                                            </div><hr/>
                                            <div class="margiv-top-10">
                                                <a href="javascript:;" id="update_account_btn" class="btn green" disabled> Save Changes </a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tab_1_4">
                                        @if(count($activities) < 1)
                                            <center><em>You don't have any activity at the moment</em></center>
                                        @else 
                                            <table class="table table-striped table-hover activitylogs" id="sample_2">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Action</th>
                                                        <th>Date</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($activities as $activity)
                                                    <tr>
                                                        <td>#</td>
                                                        <td>{{ $activity->action }}</td>
                                                        <td>{{ $activity->created_at }}</td>
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
            </div>
        </div>
    </div>
@endsection
@section('modals')
    @include('members.profile.modals._change_password')
    @include('members.profile.modals._change_picture')
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var RESET = "{{URL::route('reset.store')}}";
    </script>
    <script src="{{ asset('js/pages/user_profile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection