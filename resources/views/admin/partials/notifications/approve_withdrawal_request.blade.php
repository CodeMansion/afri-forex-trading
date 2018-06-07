<a href="{{ url('mark-as-read', ['id'=>$notification->id, 'type'=>'approve-withdrawal']) }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span> Withdrawal request approved </span>
</a>
