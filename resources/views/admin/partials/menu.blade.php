<?php 
    $menu_id = (isset($menu_id)) ? $menu_id : "0.0";
    $menu_id = explode(".", $menu_id);
?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">            
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            @if(\Auth::user()->isA('super-admin'))
                @include('admin.partials.auth._super_admin')
            @elseif(\Auth::user()->isA('ds-member'))
            @endif
        </ul>
    </div>
</div>