@if(count($transactions) < 1)
    <center><em>No transaction found</em></center>
@else 
    <table class="table table-bordered table-hover activitylogs">
        <thead>
            <tr>
                <th width="30">S/N</th>
                <th>REFERENCE</th>
                <th>SERVICE</th>
                <th width="80">AMOUNT</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @php($count=1)
            @foreach($transactions as $transaction)
            <tr>
                <td>{{$count}}</td>
                <td>{{ $transaction->reference_no }}</td>
                <td> @if(isset($transaction->Category->name))
                        <span class="badge badge-success">{{ $transaction->Category->name }}</span>
                    @else
                        <span class="badge badge-warning">Transfer</span>
                    @endif
                </td>
                <td>${{ number_format($transaction->amount,2) }}</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
            @php($count++)
            @endforeach
        </tbody>
    </table>
@endif