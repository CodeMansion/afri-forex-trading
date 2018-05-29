@if(count($withdrawals) < 1)
    <center><em>There are no withdrawals</em></center>
@else
<div class="table-scrollable table-scrollable-borderless">
    <table class="table table-hover table-light">
        <thead>
            <tr class="uppercase">
                <th> AMOUNT </th>
                <th> STATUS </th>
                <th> DATE </th>
            </tr>
        </thead>
        <tbody>
            @foreach($withdrawals as $withdrawal)
                <tr>
                    <td> ${{ number_format($withdrawal->amount,2) }} </td>
                    <td><span class="badge badge{{ withdrawal_status($withdrawal->status,'class') }}">{{ withdrawal_status($withdrawal->status,'name') }}</span></td>
                    <td><span class="bold theme-font">{{ $withdrawal->created_at->diffForHumans() }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif