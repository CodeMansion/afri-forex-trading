<a href="{{ url('mark-as-read', ['id'=>$notification->id, 'type'=>'unsubscribe']) }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span>Expired Monthly Subscription </span>
</a>
