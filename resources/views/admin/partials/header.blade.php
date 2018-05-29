<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="index.html"> 
                <!-- <img src="{{ asset('assets/layouts/layout2/img/logo-default.png') }}" alt="logo" class="logo-default" />  -->
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>     
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <div class="page-actions">
            <div class="btn-group">
                <button type="button" class="btn btn-circle red dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="hidden-sm hidden-xs">Quick Actions&nbsp;</span>&nbsp;
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ URL::route('WithdrawalIndex') }}"><i class="icon-docs"></i> View Withdrawals </a> </li>
                    <!-- <li><a href="javascript:;"><i class="icon-tag"></i> Post News </a></li> -->
                    <li><a href="{{ URL::route('msgIndex') }};"><i class="icon-share"></i> Send Messages </a></li>
                    <li><a href="{{ url('/registration') }}"><i class="icon-flag"></i> Register</a></li>
                    <li><a href="{{ URL::route('membersIndex') }}"><i class="icon-users"></i> Members</a></li>
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
                    
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="{{ asset('assets/layouts/layout2/img/avatar3_small.jpg') }}" />
                            <span class="username username-hide-on-mobile"> {{ \Auth::user()->username }} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li><a href="#"><i class="icon-user"></i> My Profile </a></li>
                            <li><a href="{{ url('/logout') }}"><i class="icon-key"></i> Log Out </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"> </div>