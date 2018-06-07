<ul class="list-group">
    <li class="list-group-item">
        Initial Wallet Balance: <span class="pull-right">${{ number_format($withdrawal->initial_wallet_balance,2) }}</span>
    </li>
    <li class="list-group-item">
        Withdrawal Charge: <span class="pull-right">${{ number_format($withdrawal->withdrawal_charge,2) }}</span>
    </li>
    <li class="list-group-item">
        Withdrawal Amount: <span class="pull-right">${{ number_format($withdrawal->withdrawal_amount,2) }}</span>
    </li>
    <li class="list-group-item">
        Total Amount: <span class="pull-right">${{ number_format($withdrawal->deducted_amount,2) }}</span>
    </li>
    <li class="list-group-item">
        Status: <span class="pull-right"><span class="badge badge-{{ withdrawal_status($withdrawal->status,'class') }}">{{ withdrawal_status($withdrawal->status,'name') }}</span></span>
    </li>
    <li class="list-group-item">
        Date: <span class="pull-right">{{ $withdrawal->created_at->diffForHumans() }}</span>
    </li>
    <li class="list-group-item">
        Updated: <span class="pull-right">{{ $withdrawal->updated_at->diffForHumans() }}</span>
    </li>
</ul>
