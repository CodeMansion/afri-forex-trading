<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="index.html"> 
                <img src="{{ asset('assets/layouts/layout2/img/logo-default.png') }}" alt="logo" class="logo-default" /> 
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>     
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        
        <div class="page-top">
            <div class="col-md-4" style="padding:15px;">
                <input type="text" id="mt-target-1" style="width:400px;height: 30px;border: 1px solid grey;padding: 10px;" value="{{ URL::route('register') }}/{{ auth()->user()->slug }}">
                <a href="javascript:;" style="padding: 5px;" class="mt-clipboard" data-clipboard-action="copy" data-clipboard-target="#mt-target-1" target="Copy Link to clipboard">
                    <i class="icon-note"></i>
                </a>
            </div>    
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <span class="badge badge-danger"> 0 </span>
                        </a>
                        <ul class="dropdown-menu">
                            
                        </ul>
                    </li>
                    <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-danger"> 0 </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>You have <span class="bold">1 New</span> Messages</h3>
                                <!-- <a href="app_inbox.html">view all</a> -->
                            </li>
                            <li>
                                
                            </li>
                        </ul>
                    </li>
                    
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="{{ asset('images/default.png') }}" />
                            <span class="username username-hide-on-mobile"> {{ \Auth::user()->username }} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li><a href="#"><i class="icon-user"></i> My Profile </a></li>
                            <li><a href="#"><i class="icon-envelope-open"></i> My Inbox<span class="badge badge-danger"> 3 </span></a></li>
                            <li class="divider"> </li>
                            <li><a href="{{ url('/logout') }}"><i class="icon-key"></i> Log Out </a></li>
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