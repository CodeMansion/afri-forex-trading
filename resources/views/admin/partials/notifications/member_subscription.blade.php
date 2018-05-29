<a href="{{ url('mark-as-read', ['id'=>$notification->id, 'type'=>'subscription']) }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span> A member subscribe for a new service. </span>
</a>
