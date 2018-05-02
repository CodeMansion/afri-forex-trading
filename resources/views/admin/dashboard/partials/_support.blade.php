<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption caption-md">
            <i class="icon-bar-chart font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase"><i class="icon-earphones-alt"></i> Customer Support</span>
            <span class="caption-helper"><img src="{{ asset('images/loader.gif') }}" id="dispute_loader" /> </span>
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
            <div class="general-item-list" id="show_dispute">
                @forelse($disputes as $dispute)
                    <div class="item">
                        <div class="item-head">
                            <div class="item-details">
                                <img class="item-pic rounded" src="{{ asset('images/default.png') }}">
                                <a href="" class="item-name primary-link">{{ $dispute->user->Profile->full_name }}</a>
                                <span class="item-label">{{ $dispute->created_at->diffForHumans() }}</span>
                            </div>
                            <span class="item-status">
                                <span class="badge badge-empty badge-{{ dispute_status($dispute->status,'class') }}"></span> 
                                {{ dispute_status($dispute->status,'name') }}
                            </span>
                        </div>
                        <div class="item-body"> {{ strip_tags(word_counter($dispute->message, 8,'...')) }} </div>
                    </div>
                @empty  
                    <center><em>There are no disputes</em></center>
                @endforelse
            </div>
        </div>
        <div class="scroller-footer">
            <div class="btn-arrow-link pull-right">
                <a href="{{ URL::route('disputeIndex') }}">See All Records</a>
                <i class="icon-arrow-right"></i>
            </div>
        </div>
    </div>
</div>