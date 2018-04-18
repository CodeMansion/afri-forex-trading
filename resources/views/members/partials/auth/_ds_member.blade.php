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
    <a href="#">
        <i class="icon-envelope"></i>
        <span class="title">Support Ticket</span>
    </a>
</li>            
<li class="nav-item  ">
    <a href="{{ URL::route('transactions.index') }}" class="nav-link nav-toggle">
        <i class="icon-briefcase"></i>
        <span class="title">Transactions</span>
        <span class="arrow"></span>
    </a>
</li>