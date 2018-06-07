<a href="{{ url('mark-as-read', ['id'=>$notification->id, 'type'=>'decline-withdrawal']) }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span> Withdrawal request declined </span>
</a>
