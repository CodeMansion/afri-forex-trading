<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase"> <i class=" icon-feed"></i> My Withdrawals</span>
            <span class="caption-helper"><img src="{{ asset('images/loader.gif') }}" id="latest_news_loader" /> </span>
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
            <div class="" id="show_latest_news">
                @if(count($transactions) < 1)
                    <center><em>There are no withdrawals</em></center>
                @else
                <div class="table-scrollable table-scrollable-borderless">
                    
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