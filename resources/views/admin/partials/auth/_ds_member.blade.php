<li class="nav-item start active open">
                <a href="{{ URL::route('dashboard') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ URL::route('users.index') }}" class="nav-link nav-toggle">
                    <i class="icon-bulb"></i>
                    <span class="title">User Profile</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ URL::route('platforms.index') }}" class="nav-link nav-toggle">
                    <i class="icon-diamond"></i>
                    <span class="title">Platforms</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="#" class="nav-link ">
                            <span class="title">Packages</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;">
                    <i class="icon-puzzle"></i>
                    <span class="title">Messages</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ URL::route('messaging.index') }}">
                    <i class="icon-settings"></i>
                    <span class="title">Disputes</span>
                </a>
            </li>            
            <li class="nav-item  ">
                <a href="{{ URL::route('transactions.index') }}" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Transactions</span>
                    <span class="arrow"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ URL::route('activity.index') }}">
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
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">System Settings</span>
                    <span class="arrow"></span>
                </a>
            </li>