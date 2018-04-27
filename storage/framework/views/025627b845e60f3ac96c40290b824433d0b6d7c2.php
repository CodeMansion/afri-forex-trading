<?php $config = \App\GeneralSetting::find(1); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="author" content="">
        <meta name="description" content="" />
        <link rel="shortcut icon" href="<?php echo e(asset('images/elect-ng-logo.png')); ?>" type="image/png" />

        <title>Administrator | </title>
        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')); ?>" rel="stylesheet" type="text/css" />
        <?php echo $__env->yieldContent('extra_style'); ?>
        
        <link href="<?php echo e(asset('assets/global/css/components-md.min.css')); ?>" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo e(asset('assets/global/css/plugins-md.min.css')); ?>" rel="stylesheet" type="text/css" />

        <?php echo $__env->yieldContent('extra_style_after'); ?>
        
        <link href="<?php echo e(asset('assets/layouts/layout2/css/layout.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('assets/layouts/layout2/css/themes/blue.min.css')); ?>" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo e(asset('assets/layouts/layout2/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet" type="text/css" />
        
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-footer-fixed">
        <audio id="notifyAudio" style="display:none;"><source src="<?php echo e(asset('js/plucky.mp3')); ?>" type="audio/mpeg"></audio>
        <?php echo $__env->make('admin.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="page-container">
            <?php echo $__env->make('admin.partials.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>   
            </div>
            <?php echo $__env->yieldContent('modals'); ?>
        </div>
        <?php echo $__env->make('admin.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <script src="<?php echo e(asset('assets/global/plugins/jquery.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/js.cookie.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/global/plugins/jquery.blockui.min.js')); ?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <script src="<?php echo e(asset('assets/global/plugins/bootstrap-toastr/toastr.min.js')); ?>" type="text/javascript"></script>
        <?php echo $__env->yieldContent('extra_script'); ?>

        <!-- END PAGE LEVEL PLUGINS -->
        <script src="<?php echo e(asset('assets/global/scripts/app.min.js')); ?>" type="text/javascript"></script>
        <script>
            var NOTIFY = "<?php echo e(URL::route('dashboardNotify')); ?>";
            var NOTIFY_COUNT = parseInt(<?php echo count(auth()->user()->unreadNotifications); ?>);
            var ENABLE_SOUND = parseInt(<?php echo $config['enable_sound_notification']; ?>);
            var ENABLE_PUSH = parseInt(<?php echo $config['enable_push_notification']; ?>);
        </script>
        <script src="<?php echo e(asset('js/utilities.js')); ?>" type="text/javascript"></script>

        <?php echo $__env->yieldContent('after_script'); ?>
        
        <script src="<?php echo e(asset('assets/pages/scripts/ui-toastr.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/pages/scripts/dashboard.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/layouts/layout/scripts/layout.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/layouts/layout/scripts/demo.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/layouts/global/scripts/quick-sidebar.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('assets/layouts/global/scripts/quick-nav.min.js')); ?>" type="text/javascript"></script>

        <!---notification messages---->
        <?php if(\Session::has('error')): ?>
            <script type="text/javascript">
                toastr.error("<?php echo \Session::get('error'); ?>");
            </script>
        <?php endif; ?>
        <?php if(\Session::has('success')): ?>
            <script type="text/javascript">
                toastr.success("<?php echo \Session::get('success'); ?>");
            </script>
        <?php endif; ?>
        <?php if(\Session::has('info')): ?>
            <script type="text/javascript">
                toastr.info("<?php echo \Session::get('info'); ?>");
            </script>
        <?php endif; ?>
        <?php if(\Session::has('warning')): ?>
            <script type="text/javascript">
                toastr.warning("<?php echo \Session::get('warning'); ?>");
            </script>
        <?php endif; ?>

        <script>
            $(document).ready(function(){
                $("#close-notify").on("click", function(){
                    $("#close").hide();
                });
            });
        </script>
    </body>
</html>
    