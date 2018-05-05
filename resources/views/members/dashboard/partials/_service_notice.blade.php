@if(isset($withdrawal->status))
    <div class="alert alert-warning" style="font-size:17px;">
        <p>
            You made a withdrawal request | 
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