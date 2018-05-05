<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase"><i class="icon-refresh"></i> Activity Logs</span>
            <span class="caption-helper"><img src="{{ asset('images/loader.gif') }}" id="activity_loader" /> </span>
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
            <div class="" id="show_logs">
                <ul class="feeds">
                    @forelse($activities as $activity)
                        <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-info">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> 
                                            {{ $activity->action }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col3">
                                <div class="date pull-right"> {{ $activity->created_at->diffForHumans() }} </div>
                            </div>
                        </li>
                    @empty
                        <center><em>There are no activity logs</em></center>
                    @endforelse
                </ul>
            </div>
        </div>
        @if(auth()->user()->is_admin)
        <div class="scroller-footer">
            <div class="btn-arrow-link pull-right">
                <a href="{{ URL::route('activity.index') }}">See All Records</a>
                <i class="icon-arrow-right"></i>
            </div>
        </div>
        @endif
    </div>
</div>