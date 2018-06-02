<li class="nav-item {{menu_active($menu_id, 1)}}">
    <a href="{{ URL::route('dashboard') }}" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
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