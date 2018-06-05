
@extends('admin.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Member Profile Page </strong> <small>PERSONAL PROFILE</small> 
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
            <li><i class="icon-users"></i><a href="{{ URL::route('membersIndex') }}">Members</a><i class="fa fa-angle-right"></i></li>
            <li><span>{{ strtoupper($profile['full_name']) }} - Profile</span></li>
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
                        <div class="profile-usertitle-name"> {{ strtoupper($profile['full_name']) }} </div>
                        <div class="profile-usertitle-job"> 
                            <span>Member</span> 
                        </div>
                        @if(isset($balance->amount))
                        <h3 style="color:red;">
                            <strong>Balance: ${{ number_format($balance->amount) }}</strong>
                        </h3>
                        @endif
                    </div><hr/>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li style="margin-bottom: 10px;">
                                <center><a href="">Status: <span class="badge badge-{{ member_status($profile->is_active,'class') }}">{{ member_status($profile->is_active,'name') }}</span></a></center>
                            </li>
                            <li>
                                @if($profile['is_active'] == 0)
                                    <a href="#" id="activate_account" class="btn red btn-xs">Activate This Member</a>
                                @endif
                            </li>
                            @if($profile['is_admin'] == 0)
                            <li data-target="#refund-wallet" data-toggle="modal"><a href="#"><i class="icon-wallet"></i> Fund Wallet </a></li>
                            @endif
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
                                    <li><a href="#tab_1_4" data-toggle="tab">Activity Logs</a></li>
                                    
                                    <!-- <li> <a href="#tab_1_3" data-toggle="tab">Payment Account Info</a></li> -->
                                    <li><a href="#tab_1_5" data-toggle="tab">Earnings</a></li>
                                    <li><a href="#tab_1_6" data-toggle="tab">Transactions</a></li>
                                    
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        @include('members.profile.partials._profile')
                                    </div>
                                    <div class="tab-pane" id="tab_1_4">
                                        @include('members.profile.partials._activity_logs')
                                    </div>
                                    
                                    <!-- <div class="tab-pane" id="tab_1_3">
                                        @include('members.profile.partials._account_info')
                                    </div> -->
                                    <div class="tab-pane" id="tab_1_5">
                                        @include('members.profile.partials._earnings')
                                    </div>
                                    <div class="tab-pane" id="tab_1_6">
                                        @include('members.profile.partials._transactions')
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
    @include('admin.members.modals._refund_wallet')
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var RESET = "{{URL::route('reset.store')}}";
        var SLUG = "{{ $profile['slug'] }}";
        var ACTIVATE = "{{ URL::route('activateMemberAccount') }}";
        var confirm_password = "{{ URL::route('ConfirmPassword') }}";
        var refund_wallet = "{{ URL::route('RefundWallet') }}";
    </script>
    <script src="{{ asset('js/pages/user_profile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection