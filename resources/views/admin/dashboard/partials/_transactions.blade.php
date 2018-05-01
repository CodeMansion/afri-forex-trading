<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">Recent Transactions</span>
            <span class="caption-helper"><img src="{{ asset('images/loader.gif') }}" id="transaction_loader" /> </span>
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
            <div class="" id="show_transaction">
                @if(count($transactions) < 1)
                    <center><em>There are no transactions</em></center>
                @else
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr class="uppercase">
                                <th colspan="2"> MEMBER </th>                                
                                <th> SERVICE</th>
                                <th> AMOUNT </th>
                                <th> CATEGORY </th>
                                <th> DATE </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class="fit"><img class="user-pic rounded" src="{{ asset('images/default.png') }}"> </td>
                                    <td><a href="javascript:;" class="primary-link">{{ $transaction->user->full_name }}</a></td>
                                    <td> <span class="badge badge-success">
                                        @if(isset($transaction->Platform->name))
                                        {{  $transaction->Platform->name }}</span> 
                                        @else
                                         Transfer
                                        @endif
                                    </td>
                                    <td> ${{ number_format($transaction->amount,2) }} </td>
                                    <td><span class="badge badge-primary">{{ $transaction->Category->name }}</span></td>
                                    <td><span class="bold theme-font">{{ $transaction->created_at->diffForHumans() }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        <div class="scroller-footer">
            <div class="btn-arrow-link pull-right">
                <a href="javascript:;">See All Records</a>
                <i class="icon-arrow-right"></i>
            </div>
        </div>
    </div>
</div>