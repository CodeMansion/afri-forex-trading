<li class="nav-item {{menu_active($menu_id, 1)}}">
    <a href="{{ URL::route('dashboard') }}" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
</li>
<li class="nav-item {{menu_active($menu_id, 2)}}">
    <a href="{{ URL::route('membersIndex') }}" class="nav-link nav-toggle">
        <i class="icon-user"></i>
        <span class="title">My Profile</span>
        <span class="arrow"></span>
    </a>
</li>
<li class="nav-item {{menu_active($menu_id, 3)}}">
    <a href="{{ URL::route('platforms.index') }}" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">My Services</span>
        <span class="arrow"></span>
    </a>
</li>
<li class="nav-item {{menu_active($menu_id, 8)}}">
    <a href="{{ URL::route('earningsIndex') }}" class="nav-link nav-toggle">
        <i class="icon-handbag"></i>
        <span class="title">My Earnings</span>
        <span class="arrow"></span>
    </a>
</li>
<li class="nav-item {{menu_active($menu_id, 4)}}">
    <a href="{{ URL::route('downlines.index') }}">
        <i class="icon-puzzle"></i>
        <span class="title">My DownLines</span>
        <span class="arrow"></span>
    </a>
</li>
<li class="nav-item {{menu_active($menu_id, 5)}}">
    <a href="{{ URL::route('disputeIndex') }}">
        <i class="icon-envelope"></i>
        <span class="title">Support Ticket</span>
    </a>
</li>            
<li class="nav-item  {{menu_active($menu_id, 6)}}">
    <a href="{{ URL::route('transactions.index') }}" class="nav-link nav-toggle">
        <i class="icon-briefcase"></i>
        <span class="title">My Transactions</span>
        <span class="arrow"></span>
    </a>
</li>
<li class="nav-item {{menu_active($menu_id, 7)}}">
    <a href="{{ URL::route('transactions.index') }}" class="nav-link nav-toggle">
        <i class="icon-speech"></i>
        <span class="title">My Testimonies</span>
        <span class="arrow"></span>
    </a>
</li>