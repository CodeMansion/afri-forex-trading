<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="author" content="">
        <meta name="description" content="" />
        <link rel="shortcut icon" href="{{ asset('images/elect-ng-logo.png') }}" type="image/png" />

        <title>AfriMarket | @yield('title')</title>
        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/pages/css/login.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="login">
        
        @yield('content') 
        <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
        
        <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/pages/scripts/login.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/pages/scripts/ui-toastr.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/utilities.js') }}" type="text/javascript"></script>
       
        @if($errors->has('email') || $errors->has('password'))
            <script type="text/javascript">
                toastr.error("{{ $errors->first('email') }} {{ $errors->first('password') }}");
            </script>
        @endif
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

        <script>
            $(document).ready(function(){
                $("#close-notify").on("click", function(){
                    $("#close").hide();
                });
            });
        </script>        
        @yield('javascript') 
    </body>
</html>
    