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
            <span class="title">Services</span>
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
    <li class="nav-item {{menu_active($menu_id, 4)}}">
        <a href="{{ URL::route('disputeIndex') }}">
            <i class="icon-envelope"></i>
            <span class="title">Disputes</span>
        </a>
    </li>
    <li class="nav-item {{menu_active($menu_id, 5)}}">
        <a href="{{ URL::route('membersIndex') }}" class="nav-link nav-toggle">
            <i class="icon-users"></i>
            <span class="title">Members</span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{menu_active($menu_id, 6)}}">
        <a href="{{ URL::route('transactions.index') }}" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">Transactions</span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{menu_active($menu_id, 7)}}">
        <a href="{{ URL::route('activity.index') }}">
            <i class="icon-wallet"></i>
            <span class="title">Activity Logs</span>
        </a>
    </li>
    <li class="nav-item {{menu_active($menu_id, 10)}}">
    <a href="{{ URL::route('testimonies.index') }}" class="nav-link nav-toggle">
        <i class="icon-speech"></i>
        <span class="title">My Testimonies</span>
        <span class="arrow"></span>
    </a>
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
                <a href="{{ URL::route('generalSettingIndex') }}" class="nav-link ">
                    <span class="title">General Settings</span>
                </a>
            </li>
        </ul>
    </li>