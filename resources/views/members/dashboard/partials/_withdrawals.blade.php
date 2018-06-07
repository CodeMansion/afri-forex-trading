<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase"> <i class=" icon-feed"></i> Withdrawals</span>
            <span class="caption-helper"><img src="{{ asset('images/loader.gif') }}" id="withdrawal_loader" /> </span>
        </div>
        <div class="inputs">
            <div class="portlet-input input-inline input-small ">
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input type="text" class="form-control form-control-solid input-circle" placeholder="search..."> 
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <div class="scroller" style="height: 228px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
            <div class="" id="show_withdrawals">
                @if(count($withdrawals) < 1)
                    <center><em>There are no withdrawal request</em></center>
                @else
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr class="uppercase">
                                @if(auth()->user()->is_admin == 1)
                                <th>MEMBER</th>
                                @endif
                                <th> AMOUNT </th>
                                <th> STATUS </th>
                                <th> DATE </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $withdrawal)
                                <tr>
                                    @if(auth()->user()->is_admin == 1)
                                    <td>{{ $withdrawal->user->full_name }}</td>
                                    @endif
                                    <td> ${{ number_format($withdrawal->withdrawal_amount,2) }} </td>
                                    <td><span class="badge badge{{ withdrawal_status($withdrawal->status,'class') }}">{{ withdrawal_status($withdrawal->status,'name') }}</span></td>
                                    <td><span class="bold theme-font">{{ $withdrawal->created_at->diffForHumans() }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        <!-- <div class="scroller-footer">
            <div class="btn-arrow-link pull-right">
                <a href="javascript:;">See All Records</a>
                <i class="icon-arrow-right"></i>
            </div>
        </div> -->
    </div>
</div>