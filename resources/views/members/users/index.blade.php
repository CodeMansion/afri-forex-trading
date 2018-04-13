@extends('members.partials.app')

@section('content')
<div class="profile">
    <div class="tabbable-line tabbable-full-width">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#tab_1_1" data-toggle="tab" aria-expanded="true"> Overview </a>
            </li>
            <li class="">
                <a href="#tab_1_3" data-toggle="tab" aria-expanded="false"> Account Setup </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-unstyled profile-nav">
                            <li>
                                <img src="{{ asset('assets/pages/media/profile/people19.png') }}" class="img-responsive pic-bordered" alt="">
                                <a href="javascript:;" class="profile-edit"> </a>
                            </li>
                        </ul>
                    </div>


                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-8 profile-info">
                                <h1 class="font-green sbold uppercase">{{ auth()->user()->full_name }}</h1>
                                {{-- <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.
                                </p> --}}
                            </div>
                        </div>
                        <!--end row-->
                        <div class="tabbable-line tabbable-custom-profile">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_11" data-toggle="tab" aria-expanded="true"> Latest Customers </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_11">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-briefcase"></i> Account Name </th>
                                                    <th class="hidden-xs">
                                                        <i class="fa fa-question"></i> Account Username </th>
                                                    <th>
                                                        <i class="fa fa-bookmark"></i> Payment Platform </th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"> Clement Jegede </a>
                                                    </td>
                                                    <td class="hidden-xs"> admin </td>
                                                    <td> PayPal
                                                        <span class="label label-success label-sm"> Active </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--tab_1_2-->
            <div class="tab-pane" id="tab_1_3">
                <div class="row profile-account">
                    <div class="col-md-3">
                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                            <li class="active">
                                <a data-toggle="tab" href="#tab_1-1" aria-expanded="false">
                                    <i class="fa fa-cog"></i> Personal info </a>
                                <span class="after"> </span>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#tab_2-2" aria-expanded="false">
                                    <i class="fa fa-picture-o"></i> Change Avatar </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#tab_3-3" aria-expanded="false">
                                    <i class="fa fa-lock"></i> Change Password </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" href="#tab_4-4" aria-expanded="false">
                                    <i class="fa fa-eye"></i> Account Settings </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div id="tab_1-1" class="tab-pane active">
                                <form role="form" action="#">
                                    <div class="form-group">
                                        <label class="control-label">FullName</label>
                                        <input type="text" value="{{ auth()->user()->full_name }}" placeholder="John" class="form-control"> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" value="{{ auth()->user()->username }}" placeholder="John" class="form-control"> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" value="{{ auth()->user()->email }}" placeholder="John" class="form-control"> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mobile Number</label>
                                        <input type="text" value="{{ auth()->user()->Profile->telephone }}" placeholder="+1 646 580 DEMO (6284)" class="form-control"> 
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Country</label>
                                        <select class="form-control" name="country_id" id="country_id">
                                            <option value="">Select...</option>
                                            <option value="1">Nigeria</option>
                                            <option value="2">United States</option>
                                            <option value="3">South Africa</option>
                                            <option value="4">Saudi Arabia</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">State</label>
                                        <select class="form-control" name="country_id" id="country_id">
                                            <option value="">Select...</option>
                                            <option value="1">Nigeria</option>
                                            <option value="2">United States</option>
                                            <option value="3">South Africa</option>
                                            <option value="4">Saudi Arabia</option>
                                        </select>
                                    </div>
                                    <div class="margiv-top-10">
                                        <a href="javascript:;" class="btn green"> Save Changes </a>
                                        <a href="javascript:;" class="btn default"> Cancel </a>
                                    </div>
                                </form>
                            </div>
                            <div id="tab_2-2" class="tab-pane">
                                <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    </p>
                                <form action="#" role="form">
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="..."> </span>
                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-danger"> NOTE! </span>
                                            <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                        </div>
                                    </div>
                                    <div class="margin-top-10">
                                        <a href="javascript:;" class="btn green"> Submit </a>
                                        <a href="javascript:;" class="btn default"> Cancel </a>
                                    </div>
                                </form>
                            </div>
                            <div id="tab_3-3" class="tab-pane">
                                <form action="#">
                                    <div class="form-group">
                                        <label class="control-label">Current Password</label>
                                        <input type="password" class="form-control"> </div>
                                    <div class="form-group">
                                        <label class="control-label">New Password</label>
                                        <input type="password" class="form-control"> </div>
                                    <div class="form-group">
                                        <label class="control-label">Re-type New Password</label>
                                        <input type="password" class="form-control"> </div>
                                    <div class="margin-top-10">
                                        <a href="javascript:;" class="btn green"> Change Password </a>
                                        <a href="javascript:;" class="btn default"> Cancel </a>
                                    </div>
                                </form>
                            </div>
                            <div id="tab_4-4" class="tab-pane">
                            <form action="#">
                                    <div class="form-group">
                                        <label class="control-label">Account Name</label>
                                        <input type="text" class="form-control"> </div>
                                    <div class="form-group">
                                        <label class="control-label">Account Username</label>
                                        <input type="text" class="form-control"> </div>
                                    <div class="form-group">
                                        <label class="control-label">Account Email</label>
                                        <input type="email" class="form-control"> </div>
                                    <div class="form-group">
                                        <label class="control-label">Account Token</label>
                                        <input type="text" class="form-control"> </div>
                                    <div class="margin-top-10">
                                        <a href="javascript:;" class="btn green"> Save Info </a>
                                        <a href="javascript:;" class="btn default"> Cancel </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end col-md-9-->
                </div>
            </div>
        </div>
    </div>
</div>
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