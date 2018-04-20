<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">New Members</span>
            <span class="caption-helper"><img src="{{ asset('images/loader.gif') }}" id="members_loader" /> </span>
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
            <div class="" id="show_members">
                @forelse($members as $member)
                    <div class="mt-actions">
                        <div class="mt-action">
                            <div class="mt-action-body">
                                <div class="mt-action-row">
                                    <div class="mt-action-info ">
                                        <div class="mt-action-icon ">
                                            <i class="icon-user"></i>
                                        </div>
                                        <div class="mt-action-details ">
                                            <span class="mt-action-author">{{ strtoupper($member->full_name) }}</span>
                                            <p class="mt-action-desc">{{ $member->email }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-action-datetime ">
                                        <span class="mt-action-date"></span>
                                        <span class="mt-action-dot bg-green"></span>
                                        <span class="mt=action-time">{{ $member->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <center><em>There are no new members</em></center>
                @endforelse
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