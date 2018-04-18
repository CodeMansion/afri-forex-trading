@extends('layouts.app')
@section('title','Registration')
@section('content')
<div class="logo">
    <a href="index.html"><img src="../assets/pages/img/logo-big.png" alt="" /> </a>
</div>
<div class="portlet box blue-hoki">
    <div class="portlet-body form">
    <!-- BEGIN FORM-->
        <form action="#" method="#"class="form-horizontal">
            <center><h3 class="form-title font-green">User Registration Form</h3></center>
            <div class="form-body">
                <div class="form-group">                    
                    <div id="errors"></div>
                    <label class="col-md-3 control-label">Sponsor
                        <span class="required" aria-required="true"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Username of Your Referral" name="upline_id" id="upline_id" value="<?php if(isset($referral)): ?> {{ $referral->username }} <?php else: ?>Afri-Forex<?php endif ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Full Name
                        <span class="required" aria-required="true"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="John Doe" name="full_name" id="full_name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Username
                        <span class="required" aria-required="true"> * </span>
                    </label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Preferred Username" name="username" id="username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password
                        <span class="required" aria-required="true"> * </span>
                    </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm Password
                        <span class="required" aria-required="true"> * </span>
                    </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Email Address
                        <span class="required" aria-required="true"> * </span>
                    </label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" placeholder="Email Address" name="email" id="email"> 
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">Country
                        <span class="required" aria-required="true"> * </span>
                    </label>
                    <div class="col-md-6">
                        <select class="form-control" name="country_id" id="country_id">
                            <option value="">Select...</option>
                            <option value="1">Nigeria</option>
                            <option value="2">United States</option>
                            <option value="3">South Africa</option>
                            <option value="4">Saudi Arabia</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">State
                        <span class="required" aria-required="true"> * </span>
                    </label>
                    <div class="col-md-6">
                        <select class="form-control" name="state_id" id="state_id">
                            <option value="">Select...</option>
                            <option value="1">Nigeria</option>
                            <option value="2">United States</option>
                            <option value="3">South Africa</option>
                            <option value="4">Saudi Arabia</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Phone Number</label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-btn btn-right">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="javascript:;">+234</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">+856</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">+777</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">+1</a>
                                    </li>
                                </ul>
                            </span>
                            <div class="input-group-control">
                                <input type="phone" class="form-control" placeholder="000 111 2222" name="telephone" id="telephone"> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" id="register_user" class="btn green">Submit</button>
                        <a href="{{ url('/login') }}"><button type="button" class="btn default">Cancel</button></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- END FORM-->
@endsection
@section('javascript')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var REGISTER_URL = "{{URL::route('register.store')}}";
    </script>
    <script src="{{ asset('assets/pages/members/register.js') }}" type="text/javascript"></script>
@endsection
