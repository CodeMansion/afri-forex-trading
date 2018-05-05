@if(count($earnings) < 1)
    <center><em>No earnings found</em></center>
@else 
    <table class="table table-bordered table-hover" id="sample_2">
        <thead>
            <tr>
                <th>#</th>
                <th>SERVICE</th>
                <th>AMOUNT</th>
                <th>STATUS</th>
                <th>DATA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($earnings as $earning)
            <tr>
                <td>#</td>
                <td>{{ $earning->platform->name }}</td>
                <td>${{ number_format($earning->amount,2) }}</td>
                <td><span class="badge badge-{{ earnings_status($earning->amount,'class') }}"></span>{{ earnings_status($earning->amount,'name') }}</td>
                <td>{{ $earning->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif