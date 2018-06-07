<a href="{{ url('mark-as-read', ['id'=>$notification->id, 'type'=>'complete-withdrawal']) }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span> Withdrawal request Completed </span>
</a>
