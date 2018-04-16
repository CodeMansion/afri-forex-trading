@extends('members.partials.app')

@section('content')
    
<!-- BEGIN PORTLET -->
<div class="portlet light ">
    <div class="portlet-body">
        <div class="row margin-bottom-20">
            @if(isset($subscription))
            <div class="col-md-4">
                <a href="{{ URL::route('subscriptions.index') }}">
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="{{ asset('assets/pages/media/profile/profile_user.jpg') }}" class="img-responsive img-circle" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle" style="margin-top:10px;">
                            <center><h3 class="profile-usertitle-name">Daily Signal</h3></center>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                            <center>
                                @if($subscription->status == 1)
                                    <button type="button" class="btn btn-circle green btn-sm">Active</button>
                                @else
                                    <button type="button" class="btn btn-circle red btn-sm">Not Active</button>
                                @endif
                            </center>
                        </div>
                        <!-- END SIDEBAR BUTTONS -->
                    </div>
                </div>
                </a>
            </div>
            @elseif(isset($investment))
            <div class="col-md-4">
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="{{ asset('assets/pages/media/profile/profile_user.jpg') }}" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> Marcus Doe </div>
                            <div class="profile-usertitle-job"> Developer </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                            <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                            <button type="button" class="btn btn-circle red btn-sm">Message</button>
                        </div>
                        <!-- END SIDEBAR BUTTONS -->
                    </div>
                </div>
            </div>
            @elseif(isset($referral))
            <div class="col-md-4">
                <div class="profile-sidebar">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet ">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="{{ asset('assets/pages/media/profile/profile_user.jpg') }}" class="img-responsive" alt=""> </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> Marcus Doe </div>
                            <div class="profile-usertitle-job"> Developer </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="profile-userbuttons">
                            <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                            <button type="button" class="btn btn-circle red btn-sm">Message</button>
                        </div>
                        <!-- END SIDEBAR BUTTONS -->
                    </div>
                </div>
            </div>
            @endif
        </div> 
    </div>
</div>
<!-- END PORTLET -->
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ asset('assets/pages/scripts/charts-flotcharts.min.js') }}" type="text/javascript"></script> -->
@endsection
@section('after_script')
    <script src="{{ asset('js/pages/dashboard_chart.js') }}" type="text/javascript"></script>
@endsection