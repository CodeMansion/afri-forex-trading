<a href="{{ url('mark-as-read', ['id'=>$notification->id, 'type'=>'referral-earnings']) }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span> Received a referral bonus </span>
</a>