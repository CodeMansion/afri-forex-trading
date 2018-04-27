<?php $config = \App\GeneralSetting::find(1); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="author" content="">
        <meta name="description" content="" />
        <link rel="shortcut icon" href="{{ asset('images/elect-ng-logo.png') }}" type="image/png" />

        <title>Members | </title>
        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('assets/global/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('assets/global/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('assets/layouts/layout2/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
        @yield('extra_style')
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-footer-fixed">
        <audio id="notifyAudio" style="display:none;"><source src="{{asset('js/shut-your-mouth.mp3')}}" type="audio/mpeg"></audio>

        @include('members.partials.header')
        <div class="page-container">
            @include('members.partials.menu')
            <div class="page-content-wrapper">
                <div class="page-content">
                    @yield('content')
                </div>   
            </div>
            @yield('modals')
        </div>
        @include('admin.partials.footer')

        <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{ asset('assets/global/plugins/clipboardjs/clipboard.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
        
        @yield('extra_script')

        <!-- END PAGE LEVEL PLUGINS -->
        <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/pages/scripts/components-clipboard.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/pages/scripts/ui-toastr.min.js') }}" type="text/javascript"></script>
        
        @yield('after_script')
        
        <script>
            var NOTIFY = "{{ URL::route('dashboardNotify') }}";
            var NOTIFY_COUNT = parseInt(<?php echo count(auth()->user()->unreadNotifications); ?>);
        </script>
        
        <script src="{{ asset('js/utilities.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/layouts/layout/scripts/demo.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>

        <!---notification messages---->
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
    </body>
</html>
    