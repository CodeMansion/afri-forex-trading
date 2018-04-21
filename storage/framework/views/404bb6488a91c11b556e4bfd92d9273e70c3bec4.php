<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="index.html"> 
                <img src="<?php echo e(asset('assets/layouts/layout2/img/logo-default.png')); ?>" alt="logo" class="logo-default" /> 
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>     
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <div class="page-actions">
            <div class="btn-group">
                <button type="button" class="btn btn-circle btn-outline green dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="hidden-sm hidden-xs">Quick Actions&nbsp;</span>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:;"><i class="icon-docs"></i> New Post </a> </li>
                    <li><a href="javascript:;"><i class="icon-tag"></i> New Comment </a></li>
                    <li><a href="javascript:;"><i class="icon-share"></i> Share </a></li>
                    <li class="divider"> </li>
                    <li><a href="javascript:;"><i class="icon-flag"></i> Comments<span class="badge badge-success">4</span></a></li>
                    <li><a href="javascript:;"><i class="icon-users"></i> Feedbacks<span class="badge badge-danger">2</span></a></li>
                </ul>
            </div>
        </div>
                
        <div class="page-top">
            <form class="search-form search-form-expanded" action="#" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." name="query">
                    <span class="input-group-btn">
                        <a href="javascript:;" class="btn submit">
                            <i class="icon-magnifier"></i>
                        </a>
                    </span>
                </div>
            </form>
                    
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-danger"> 0 </span>
                        </a>
                        
                    </li>
                    <!-- <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-default"> 1 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>You have <span class="bold">1 New</span> Messages</h3>
                                <a href="app_inbox.html">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                        <a href="#">
                                            <span class="photo"><img src="<?php echo e(asset('assets/layouts/layout3/img/avatar2.jpg')); ?>" class="img-circle" alt=""> </span>
                                            <span class="subject">
                                                <span class="from"> Lisa Wong </span>
                                                <span class="time">Just Now </span>
                                            </span>
                                            <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                    
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?php echo e(asset('assets/layouts/layout2/img/avatar3_small.jpg')); ?>" />
                            <span class="username username-hide-on-mobile"> <?php echo e(\Auth::user()->username); ?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li><a href="#"><i class="icon-user"></i> My Profile </a></li>
                            <li>
                                <a href="#">
                                    <i class="icon-envelope-open"></i> My Inbox
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li><a href="<?php echo e(url('/logout')); ?>"><i class="icon-key"></i> Log Out </a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <span class="sr-only">Toggle Quick Sidebar</span>
                        <i class="icon-logout"></i>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"> </div>