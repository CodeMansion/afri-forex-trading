@if(count($transactions) < 1)
    <center><em>There are no transactions</em></center>
@else
<div class="table-scrollable table-scrollable-borderless">
    <table class="table table-hover table-light">
        <thead>
            <tr class="uppercase">
                <th colspan="2"> MEMBER </th>
                <th> AMOUNT </th>
                <th> CATEGORY </th>
                <th> DATE </th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td class="fit"><img class="user-pic rounded" src="{{ asset('images/default.png') }}"> </td>
                    <td><a href="{{ URL::route('showMember', $transaction->user->slug) }}" class="primary-link">{{ $transaction->user->full_name }}</a></td>
                    <td> ${{ number_format($transaction->amount,2) }} </td>
                    <td><span class="badge badge-primary">{{ $transaction->Category->name }}</span></td>
                    <td><span class="bold theme-font">{{ $transaction->created_at->diffForHumans() }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif