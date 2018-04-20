@extends('layouts.app')
@section('title','Registration')
@section('content')
<div class="logo">
    <a href="index.html"><img src="../assets/pages/img/logo-big.png" alt="" /> </a>
</div>
<div class="row">
    <div class="col-md-7">

        <div class="portlet light portlet-fit ">
            <div class="portlet-body">
                <div class="mt-element-step">
                    <div class="row step-background">
                        <div class="mt-step-desc">
                            <h1 style="font-size:5em;">Make Maximum Profit</h1>
                            
                            <div class="font-grey-cascade">In Three Easy Ways</div>
                            <br> </div>
                        <div class="col-md-4 bg-grey-steel mt-step-col">
                            <div class="mt-step-number">1</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Purchase</div>
                            <div class="mt-step-content font-grey-cascade">Purchasing Minimum of 1 Platform</div>
                        </div>
                        <div class="col-md-4 bg-grey-steel mt-step-col active">
                            <div class="mt-step-number">2</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Growth</div>
                            <div class="mt-step-content font-grey-cascade">Watch you Income Increase </div>
                        </div>
                        <div class="col-md-4 bg-grey-steel mt-step-col">
                            <div class="mt-step-number">3</div>
                            <div class="mt-step-title uppercase font-grey-cascade">Withdraw</div>
                            <div class="mt-step-content font-grey-cascade">Withdraw your funds at ANYTIME</div>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
        
    <div class="col-md-4 portlet-body form">
    <!-- BEGIN FORM-->
        <form action="#" method="#"class="form-horizontal">
            <center><h3 class="form-title font-green">User Registration Form</h3></center>
            
            <div class="col-md-12 form-body">
                <div class="col-md-12 form-group">                    
                    <div id="errors"></div>
                        <input type="text" class="form-control" placeholder="Username of Your Referral" name="upline_id" id="upline_id" value="<?php if(isset($referral)): ?> {{ $referral->username }} <?php else: ?>Afri-Forex<?php endif ?>" disabled>
                </div>
                <div class="col-md-12 form-group">
                        <input type="text" class="form-control" placeholder="Full Name" name="full_name" id="full_name">
                </div>
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                </div>
                <div class="col-md-12 form-group">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="country_id" id="country_id">
                        <option value="">Select...</option>
                        <option value="1">Nigeria</option>
                        <option value="2">United States</option>
                        <option value="3">South Africa</option>
                        <option value="4">Saudi Arabia</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <select class="form-control" name="state_id" id="state_id">
                        <option value="">Select...</option>
                        <option value="1">Nigeria</option>
                        <option value="2">United States</option>
                        <option value="3">South Africa</option>
                        <option value="4">Saudi Arabia</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <div class="input-group">
                        <span class="input-group-btn btn-right">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Action
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="javascript:;">+234</a></li>
                                <li><a href="javascript:;">+856</a></li>
                                <li><a href="javascript:;">+777</a></li>
                                <li><a href="javascript:;">+1</a></li>
                            </ul>
                        </span>
                        <div class="input-group-control">
                            <input type="phone" class="form-control" placeholder="000 111 2222" name="telephone" id="telephone"> 
                        </div>
                    </div>
                
                </div>
                <div class="col-md-12 form-group">
                    <center>
                        <button type="button" id="register_user" class="btn btn-large green" style="width:49%; margin:0px;">Submit</button>
                        <button type="button" class="btn default" style="width:49%; margin:0px;">Cancel</button>
                    </center>
                    <p>Are you a Register User? <a href="{{ url('/login') }}"><em>Sign In</em></a></p>
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
