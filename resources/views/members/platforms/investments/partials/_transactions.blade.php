<div class="table">
    @if(count($transactions) < 1)
        <center> <em>You have no transactions</em></center>
    @else 
    <table class="table table-striped table-bordered table-hover" id="sample_2">
        <thead>
            <tr>
                <th width="30">S/N</th>
                <th>REFERENCE NO</th>
                <th>CATEGORY</th>
                <th>AMOUNT</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @php($counter=1)
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{$counter}}</td>
                    <td>{{ $transaction->reference_no }}</td>
                    <td><label class="badge badge-success">{{ $transaction->Category->name }}</label></td>
                    <td>${{ number_format($transaction->amount,2) }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @php($counter++)
            @endforeach
        </tbody>
    </table>
    @endif
</div>