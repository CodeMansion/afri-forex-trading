<?php $__env->startSection('content'); ?>
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BAR -->
            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extra_script'); ?>
    <script src="<?php echo e(asset('assets/global/plugins/echarts/echarts.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/global/plugins/flot/jquery.flot.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/global/plugins/flot/jquery.flot.pie.min.js')); ?>" type="text/javascript"></script>
    <!-- <script src="<?php echo e(asset('assets/pages/scripts/charts-flotcharts.min.js')); ?>" type="text/javascript"></script> -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('after_script'); ?>
    <script src="<?php echo e(asset('js/pages/dashboard_chart.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>