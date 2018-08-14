@if(count($transactions) < 1)
    <center><em>No transaction found</em></center>
@else 
    <table class="table table-bordered table-hover">
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
        	@php($counter=1)
            @foreach($transactions as $transaction)
            <tr>
                <td>{{$counter}}</td>
                <td>{{ $transaction->reference_no }}</td>
                <td> @if(isset($transaction->Platform->name))
                        <span class="badge badge-success">{{ $transaction->Platform->name }}</span>
                    @else
                        <span class="badge badge-warning">Transfer</span>
                    @endif
                </td>
                <td>${{ number_format($transaction->amount,2) }}</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
            @php($counter++)
            @endforeach
        </tbody>
    </table>
@endif