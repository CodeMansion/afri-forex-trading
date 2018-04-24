<?php 
    $menu_id = (isset($menu_id)) ? $menu_id : "0.0";
    $menu_id = explode(".", $menu_id);
?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">            
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            @if(\Auth::user()->isA('ds-member'))
                @include('members.partials.auth._ds_member')
            @elseif(\Auth::user()->isA('member'))
            @endif
        </ul>
    </div>
</div>