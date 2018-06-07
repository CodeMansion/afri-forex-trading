@if(count($withdrawals) < 1)
    <center><em>There are no withdrawal request</em></center> 
@else 
    <table class="table table-bordered table-hover withdrawal" id="sample_2">
        <thead>
            <tr>
                <th>#</th>
                <th>MEMBER</th>
                <th>WITHDRAWAL AMOUNT</th>
                <th>CHARGE</th>
                <th>STATUS</th>
                <th>DATE</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @php($counter=1)
            @php($index=0)
            @foreach($withdrawals as $withdrawal)
                <tr>
                    <td>#</td>
                    <td>{{ strtoupper($withdrawal->user->full_name) }} </td>
                    <td>${{ number_format($withdrawal->withdrawal_amount,'2') }}</td> 
                    <td>${{ number_format($withdrawal->withdrawal_charge,'2') }}</td>
                    <td><span class="badge badge-{{ withdrawal_status($withdrawal->status,'class') }}">{{ withdrawal_status($withdrawal->status,'name') }}</span></td>
                    <td>{{ $withdrawal->created_at->diffForHumans() }}</td>                                                
                    <td>
                        <input type="hidden" id="withdrawal_id_{{ $index }}" value="{{ $withdrawal->id }}">
                        <a href="javascript:;" id="edit_withdrawal_{{$index}}"><i class="icon-note"></i> View</a>&nbsp;
                        @if($withdrawal->status == 0)
                        | <a href="javascript:;" id="approve_withdrawal_{{ $index }}"><i class="icon-check"></i> Approve</a>&nbsp; |
                        <a href="javascript:;" style="color:red;" id="decline_withdrawal_{{ $index }}"><i class="fa fa-close"></i> Decline</a>
                        @endif
                        @if($withdrawal->status == 1)
                        | <a href="javascript:;" style="color:green;" id="complete_withdrawal_{{ $index }}"><i class="icon-check"></i> Mark As Completed</a>&nbsp; 
                        @endif
                    </td>  
                </tr>
            @php($counter++)
            @php($index++)
            @endforeach
        </tbody>
    </table>
@endif