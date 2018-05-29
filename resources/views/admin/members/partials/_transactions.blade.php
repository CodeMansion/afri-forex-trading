@if(count($transactions) < 1)
    <center><em>No transaction found</em></center>
@else 
    <table class="table table-bordered table-hover activitylogs" id="sample_2">
        <thead>
            <tr>
                <th width="30">#</th>
                <th>REFERENCE</th>
                <th>SERVICE</th>
                <th width="80">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>#</td>
                <td>{{ $transaction->reference_no }}</td>
                <td> @if(isset($transaction->Platform->name))
                        {{ $transaction->Platform->name }}
                    @else
                        Transfer
                    @endif
                </td>
                <td>${{ number_format($transaction->amount,2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif