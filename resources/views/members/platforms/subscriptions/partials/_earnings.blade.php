<div class="table">
    @if(count($earnings) < 1)
        <center> <em>You have no earnings on this service</em></center>
    @else 
    <table class="table table-striped table-bordered table-hover" id="sample_2">
        <thead>
            <tr>
                <th width="30">#</th>
                <th>TYPE</th>
                <th>AMOUNT</th>
                <th>STATUS</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($earnings as $earning)
                <tr>
                    <td>#</td>
                    <td>{{ $earning->type->name }}</td>
                    <td><label class="badge badge-success">{{ $transaction->Category->name }}</label></td>
                    <td>${{ number_format($earning->amount,2) }}</td>
                    <td><span class="badge badge-{{ earnings_status($earning->status,'class') }}">{{ earnings_status($earning->status,'name') }}</span></td>
                    <td>{{ $earning->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>