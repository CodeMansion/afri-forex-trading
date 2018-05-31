<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase"><i class="icon-handbag"></i> My Latest Earnings</span>
            <span class="caption-helper"><img src="{{ asset('images/loader.gif') }}" id="latest_earnings_loader" /> </span>
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
            <div class="" id="show_latest_earnings">
                @if(count($earnings) < 1)
                    <center><em>There are no Latest Earnings</em></center>
                @else
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                            <tr class="uppercase">
                                <th> TYPE </th>
                                <th> SERVICE </th>
                                <th> AMOUNT </th>
                                <th> DATE </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($earnings as $earning)
                                <tr>
                                    <td>{{ $earning->type->name }}</td>
                                    <td><span class="badge badge-success"> {{ $earning->platform->name }} </span> </td>
                                    <td>${{ number_format($earning->amount,2) }}</td>
                                    <td><span class="bold theme-font">{{ $earning->created_at->diffForHumans() }}</span></td>
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
                <a href="{{ URL::route('earningsIndex') }}">See All Records</a>
                <i class="icon-arrow-right"></i>
            </div>
        </div> -->
    </div>
</div>