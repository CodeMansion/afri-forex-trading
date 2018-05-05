@forelse($disputes as $dispute)
    <div class="item">
        <div class="item-head">
            <div class="item-details">
                <img class="item-pic rounded" src="{{ asset('images/default.png') }}">
                <a href="{{ URL::route('showMember', $dispute->user->slug) }}" class="item-name primary-link">{{ $dispute->user->Profile->full_name }}</a>
                <span class="item-label">{{ $dispute->created_at->diffForHumans() }}</span>
            </div>
            <span class="item-status">
                <span class="badge badge-empty badge-{{ dispute_status($dispute->status,'class') }}"></span> 
                {{ dispute_status($dispute->status,'name') }}
            </span>
        </div>
        <a href="{{ URL::route('viewDispute', $dispute->slug) }}"><div class="item-body"> {{ strip_tags(word_counter($dispute->message, 8,'...')) }} </div><a/>
    </div>
@empty  
    <center><em>There are no disputes</em></center>
@endforelse