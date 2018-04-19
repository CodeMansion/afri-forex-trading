
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
    <i class="icon-bell"></i>
    <span class="badge badge-danger"> {{ count(auth()->user()->unreadNotifications) }} </span>
</a>
<ul class="dropdown-menu">
    <li class="external">
        <h3><span class="bold">{{ count(auth()->user()->unreadNotifications)}} pending</span> notifications</h3>
        <a href="#">view all</a>
    </li>
    <li>
    @forelse(auth()->user()->unreadNotifications as $notification)
        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
            <li id="notify_link">
                @include('admin.partials.notifications.'. snake_case(class_basename($notification->type)))
            </li>
        </ul>
    @empty
        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
            <li></li>
        </ul>
    @endforelse
    </li>
</ul>