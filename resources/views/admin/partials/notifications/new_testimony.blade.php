<a href="{{ url('/mark-as-read') }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span> New Member Testimony. </span>
</a>