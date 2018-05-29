@if(count($withdrawals) < 1)
    <center><em>There are no withdrawal request</em></center> 
@else 
    <table class="table table-bordered table-hover withdrawal" id="sample_2">
        <thead>
            <tr>
                <th>#</th>
                <th>MEMBER</th>
                <th>AMOUNT</th>
                <th>STATUS</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @php($counter=1)
            @php($index=0)
            @foreach($withdrawals as $withdrawal)
                <tr>
                    <td>#</td>
                    <td>{{ $withdrawal->user->full_name}} </td>
                    <td>${{ number_format($withdrawal->amount,'2') }}</td> 
                    <td><span class="badge badge-{{ withdrawal_status($withdrawal->status,'class') }}">{{ withdrawal_status($withdrawal->status,'name') }}</span></td>
                    <td>{{ $withdrawal->created_at->diffForHumans() }}</td>                                                 
                </tr>
            @php($counter++)
            @php($index++)
            @endforeach
        </tbody>
    </table>
@endif