<ul class="list-group">
    <li class="list-group-item">
        Wallet Balance: <span class="pull-right">${{ number_format($wallet->amount,2) }}</span>
    </li>
    <li class="list-group-item">
        Ledger Balance: <span class="pull-right">${{ number_format($ledger_balance,2) }}</span>
    </li>
    <li class="list-group-item">
        Withdrawal Amount: <span class="pull-right">${{ number_format($withdrawal->amount,2) }}</span>
    </li>
    <li class="list-group-item">
        Withdrawal Charge: <span class="pull-right">${{ number_format($withdrawal_charge,2) }}</span>
    </li>
    <li class="list-group-item">
        Status: <span class="pull-right"><span class="badge badge-{{ withdrawal_status($withdrawal->status,'class') }}">{{ withdrawal_status($withdrawal->status,'name') }}</span></span>
    </li>
    <li class="list-group-item">
        Date: <span class="pull-right">{{ $withdrawal->created_at->diffForHumans() }}</span>
    </li>
    <!-- <li class="list-group-item">
        <img src="{{ asset('images/loader.gif') }}" id="approval_loader" />
        
    </li> -->
</ul>
