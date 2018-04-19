<?php 
    $menu_id = (isset($menu_id)) ? $menu_id : "0.0";
    $menu_id = explode(".", $menu_id);
?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">            
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <?php if(\Auth::user()->isA('super-admin')): ?>
                <?php echo $__env->make('admin.partials.auth._super_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        </ul>
    </div>
</div>