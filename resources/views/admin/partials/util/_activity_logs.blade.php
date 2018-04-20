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