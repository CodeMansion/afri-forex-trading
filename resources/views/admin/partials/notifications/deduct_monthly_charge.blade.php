<a href="{{ url('mark-as-read', ['id'=>$notification->id, 'type'=>'monthly-charge']) }}" id="mark_{{ $index }}">
    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
    <span class="details">
        
    </span>Monthly charge deducted </span>
</a>
