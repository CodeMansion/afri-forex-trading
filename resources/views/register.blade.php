<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="author" content="">
        <meta name="description" content="" />

        <title>AfriMarket | New Member Registration</title>
        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/pages/css/register.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body id="register">
        <div class="row">
            <div class="col-md-7">
                <h1>Make Maximum Profit</h1> 
                <h3>In Three Easy Ways</h3>
                <ol>
                    <li>Purchase - Purchasing Minimum of 1 Platform</li>
                    <li>Growth - Watch you investment Increase</li>
                    <li>Withdraw - Withdraw your profit at ANYTIME</li>
                </ol> 
            </div>
        
            <div class="col-md-4">
                <div class="register-card">
                    <div id="errors"></div>
                    <form action="#" method="#">
                        <center>
                            <h3>New Member Registration Form</h3><hr/>
                            <div class="col-md-12 form-group">   
                                <input type="text" class="form-control" name="upline_id" id="upline_id" value="<?php if(isset($referral)): ?> {{ $referral->username }} <?php else: ?>Afri-Forex<?php endif ?>" disabled>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" placeholder="FULL NAME" name="full_name" id="full_name">
                            </div>
                            <div class="col-md-12 form-group">
                                <select class="form-control" name="country_id" id="country_id">
                                    <option value="">--Select Country--</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id']}}">{{ $country['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="phone" class="form-control" placeholder="+234(0)80 1111 2222" name="telephone" id="telephone"> 
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" placeholder="USERNAME" name="username" id="username">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" placeholder="EMAIL ADDRESS" name="email" id="email">
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="PASSWORD" name="password" id="password">
                                    <span class="input-group-addon" id="show_password">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="button" id="register_member_btn" class="btn btn-lg btn-success form-control">Submit</button>
                            </div>
                            <p>Are you a Register User? <a href="{{ url('/login') }}">Sign In Here</a></p>
                        </center>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
        
        <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/pages/scripts/ui-toastr.min.js') }}" type="text/javascript"></script>
        <script>
            var TOKEN = "{{csrf_token()}}";
            var REGISTER_URL = "{{URL::route('register.store')}}";
        </script>
        <script src="{{ asset('js/pages/registration.js') }}" type="text/javascript"></script>

        @if(\Session::has('error'))
            <script type="text/javascript">
                toastr.error("{!! \Session::get('error') !!}");
            </script>
        @endif
        @if(\Session::has('success'))
            <script type="text/javascript">
                toastr.success("{!! \Session::get('success') !!}");
            </script>
        @endif
        @if(\Session::has('info'))
            <script type="text/javascript">
                toastr.info("{!! \Session::get('info') !!}");
            </script>
        @endif
        @if(\Session::has('warning'))
            <script type="text/javascript">
                toastr.warning("{!! \Session::get('warning') !!}");
            </script>
        @endif
    </body>
</html>
    
