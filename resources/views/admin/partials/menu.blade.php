<?php 
    $menu_id = (isset($menu_id)) ? $menu_id : "0.0";
    $menu_id = explode(".", $menu_id);
?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">            
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item {{menu_active($menu_id, 1)}}">
                <a href="{{ URL::route('dashboard') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ URL::route('platforms.index') }}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Platforms</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ URL::route('packages.index') }}" class="nav-link ">
                            <span class="title">Packages</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ URL::route('packagetypes.index') }}" class="nav-link ">
                            <span class="title">Package Types</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{menu_active($menu_id, 3)}}">
                <a href="{{ URL::route('msgIndex') }}">
                    <i class="icon-puzzle"></i>
                    <span class="title">Messages</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:;">
                    <i class="icon-settings"></i>
                    <span class="title">Disputes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ URL::route('users.index') }}" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">Members</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Transactions</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">Payment Transactions</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">Transaction Category</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="?p=">
                    <i class="icon-wallet"></i>
                    <span class="title">Activity Logs</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Authentication</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">Roles & Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{menu_active($menu_id, 9)}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">System Settings</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ URL::route('mailIndex') }}" class="nav-link ">
                            <span class="title">Mail Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ">
                            <span class="title">General Settings</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>