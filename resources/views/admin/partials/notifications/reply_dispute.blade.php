<a href="{{ url('mark-as-read', ['id'=>$notification->id, 'type'=>'reply-dispute']) }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span> New Dispute Reply </span>
</a>
