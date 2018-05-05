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
                            <a href="{{ URL::route('showMember', $member->slug) }}">
                                <span class="mt-action-author">{{ strtoupper($member->full_name) }}</span>
                                <p class="mt-action-desc">{{ $member->email }}</p>
                            </a>
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