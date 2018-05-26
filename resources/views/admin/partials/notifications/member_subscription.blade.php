<a href="{{ url('/mark-as-read') }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span> A member subscribe for a new service. </span>
</a>
