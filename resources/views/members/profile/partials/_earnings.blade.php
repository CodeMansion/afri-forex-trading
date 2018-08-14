@if(count($earnings) < 1)
    <center><em>No earnings found</em></center>
@else 
    <table class="table table-bordered table-hover" id="sample_2">
        <thead>
            <tr>
                <th>S/N</th>
                <th>SERVICE</th>
                <th>AMOUNT</th>
                <th>STATUS</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @php($count=1)
            @foreach($earnings as $earning)
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $earning->platform->name }}</td>
                <td>${{ number_format($earning->amount,2) }}</td>
                <td><span class="badge badge-{{ earnings_status($earning->amount,'class') }}"></span>{{ earnings_status($earning->amount,'name') }}</td>
                <td>{{ $earning->created_at }}</td>
            </tr>
            @php($count++)
            @endforeach
        </tbody>
    </table>
@endif