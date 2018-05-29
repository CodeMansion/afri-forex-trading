<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
    <i class="icon-bell"></i>
    <span class="badge badge-danger"> {{ count(auth()->user()->unreadNotifications) }} </span>
</a>
<ul class="dropdown-menu" >
    <li class="external">
        <h3><span class="bold">{{ count(auth()->user()->unreadNotifications)}} pending</span> notifications</h3>
    </li>
    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
        @php($index=0)
        @forelse(auth()->user()->unreadNotifications as $notification)
            <li>@include('admin.partials.notifications.'. snake_case(class_basename($notification->type)))</li>
        @php($index++)
        @empty
            <li><center><em>There are no notification</em></center></li>
        @endforelse
    </ul>
</ul>