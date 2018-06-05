@if(isset($withdrawal->status))
    <div class="alert alert-warning" style="font-size:17px;">
        <p>
            @if($withdrawal->status == 0)
            You made a withdrawal request | 
            @endif
            @if($withdrawal->status == 1)
            Your withdrawal request has been approved and undergoing processing | 
            @endif
            @if($withdrawal->status == 3)
            Your withdrawal request was rejected | 
            @endif
            <span class="badge badge-{{ withdrawal_status($withdrawal->status,'class') }}">{{ withdrawal_status($withdrawal->status,'name') }}</span> |
            {{ $withdrawal->created_at->diffForHumans() }}
        </p>
    </div>
@endif

@if(isset($userSub))  
    @if($userSub->status == 2)
    <div class="alert alert-warning" style="font-size:17px;">
        <p>
            Your daily subscription has expired. Renew your subscription to continue enjoying daily investment tips. 
            <span class="badge badge-{{ subscription_status($userSub->status,'class') }}">{{ subscription_status($userSub->status,'name') }}</span> |
            {{ $userSub->updated_at->diffForHumans() }}
        </p>
    </div>
    @endif
@endif