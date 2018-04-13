@extends('admin.partials.app')

@section('content')
    <h1 class="page-title"> Admin Platforms <small>statistics, charts, recent events and reports</small> </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{ URL::route('dashboard') }} ">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ URL::route('platforms.index') }} ">Platforms</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Show</span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">{{ $platform->name }} </span>
                <span class="caption-helper">Displaying list of {{ $platform->name }}  Users</span>                        
            </div>
            {{-- <div class="actions">
                <div class="btn-group">
                    <a class="font-white btn green pull pull-left" data-toggle="modal" data-target="#new-platform" title="Add"><i class="i"></i> Create New Platform</a>
                    <a class="btn green-haze btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                        <i class="fa fa-angle-down"></i>
                    </a> 
                    <ul class="dropdown-menu pull-right">
                        
                    </ul>
                </div>
            </div> --}}
        </div>
    @if(isset($subscriptions))    
        <div class="portlet-body util-btn-margin-bottom-5">
            <div id="serverErrors"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="purchases">
                                @if(count($subscriptions) < 1)
                                    <div class="danger-alert">
                                        <i class="fa fa-warning"></i> <em>There are no subscription available currently.</em>
                                    </div>
                                @else 
                                    <table class="table table-striped table-hover platforms" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>User</th> 
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Expire Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($counter=1)
                                            @php($index=0)
                                            @forelse($subscriptions as $subscription)
                                                <tr>
                                                    <td>{{ $counter++}}</td>
                                                    <td>{{ $subscription->User->full_name}} </td>
                                                    <td>{{ $subscription->amount}}</td>
                                                    <td>
                                                        @if($subscription->status == 1)
                                                                <label class="label label-success btn-sm"><i class="fa fa-minus-square-o"></i>Active</label>
                                                        @else
                                                            <label class="label label-danger btn-sm"><i class="fa fa-minus-square-o"></i>Not Active</label>
                                                        @endif
                                                    </td>
                                                    <td>{{ $subscription->expiry_date }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu pull-left" role="menu">                                   
                                                                <li><a href="{{ URL::route('platforms.show',$platform->slug) }}"><i class="icon-note"></i>View Details</a></li>          
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php($index++)
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(isset($investments))
    <div class="portlet-body util-btn-margin-bottom-5">
            <div id="serverErrors"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="purchases">
                                @if(count($investments) < 1)
                                    <div class="danger-alert">
                                        <i class="fa fa-warning"></i> <em>There are no investments available currently.</em>
                                    </div>
                                @else 
                                    <table class="table table-striped table-hover platforms" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th> 
                                                <th>Package</th>
                                                <th>Package Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($counter=1)
                                            @php($index=0)
                                            @forelse($investments as $investment)
                                                <tr>
                                                    <td>{{ $counter++}}</td>
                                                    <td>{{ $investment->User->full_name}} </td>
                                                    <td>{{ $investment->Package->name}} </td>
                                                    <td>{{ $investment->PackageType->name}} </td>
                                                    <td>{{ $investment->investment_amount}}</td>
                                                    <td>
                                                        @if($investment->status == 1)
                                                                <label class="label label-success btn-sm"><i class="fa fa-minus-square-o"></i>Active</label>
                                                        @else
                                                            <label class="label label-danger btn-sm"><i class="fa fa-minus-square-o"></i>Not Active</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu pull-left" role="menu">                                   
                                                                <li><a href="{{ URL::route('platforms.show',$platform->slug) }}"><i class="icon-note"></i>View Details</a></li>          
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php($index++)
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(isset($referrals))
    <div class="portlet-body util-btn-margin-bottom-5">
        <div id="serverErrors"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="purchases">
                            @if(count($referrals) < 1)
                                <div class="danger-alert">
                                    <i class="fa fa-warning"></i> <em>There are no referrer available currently.</em>
                                </div>
                            @else 
                                <table class="table table-striped table-hover platforms" id="sample_2">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>User</th> 
                                            <th>DownLine Count</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($counter=1)
                                        @php($index=0)
                                        @forelse($referrals as $referral)
                                            <tr>
                                                <td>{{ $counter++}}</td>
                                                <td>{{ $referral->User->full_name}} </td>
                                                <td>{{ $referral->DownLine->count()}}</td>
                                                <td>
                                                    @if($referral->status == 1)
                                                            <label class="label label-success btn-sm"><i class="fa fa-minus-square-o"></i>Active</label>
                                                    @else
                                                        <label class="label label-danger btn-sm"><i class="fa fa-minus-square-o"></i>Not Active</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                        <ul class="dropdown-menu pull-left" role="menu">                                   
                                                            <li><a href="{{ URL::route('platforms.show',$platform->slug) }}"><i class="icon-note"></i>View Details</a></li>          
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php($index++)
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" ="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection
