<li class="nav-item {{menu_active($menu_id, 1)}}">
    <a href="{{ URL::route('dashboard') }}" class="nav-link nav-toggle">
        <i class="icon-home"></i>
        <span class="title">Dashboard</span>
        <span class="selected"></span>
        <span class="arrow open"></span>
    </a>
</li>
<!-- <li class="nav-item {{menu_active($menu_id, 2)}}">
    <a href="{{ URL::route('membersIndex') }}" class="nav-link nav-toggle">
        <i class="icon-user"></i>
        <span class="title">My Profile</span>
        <span class="arrow"></span>
    </a>
</li> -->
<li class="nav-item {{menu_active($menu_id, 11)}}">
    <a href="{{ URL::route('testimonies.index') }}" class="nav-link nav-toggle">
        <i class="icon-speech"></i>
        <span class="title">Testimonies</span>
        <span class="arrow"></span>
    </a>
</li>