@extends('admin.partials.app')

@section('content')
    <h1 class="page-title"> Admin Dashboard <small>statistics, charts, recent events and reports</small> </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Dashboard</span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Platfroms </span>
                <span class="caption-helper">Displaying list of platforms </span>                        
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a class="font-white btn green pull pull-left" data-toggle="modal" data-target="#new-platform" title="Add"><i class="i"></i> Create New Platform</a>
                    {{-- <a class="btn green-haze btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                        <i class="fa fa-angle-down"></i>
                    </a> --}}
                    <ul class="dropdown-menu pull-right">
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div id="serverErrors"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="tab-content">
                            <div class="tab-pane active" id="purchases">
                                @if(count($platforms) < 1)
                                    <div class="danger-alert">
                                        <i class="fa fa-warning"></i> <em>There are no platform available currently. Click on the button above to add a new platform.</em>
                                    </div>
                                @else 
                                    <table class="table table-striped table-hover platform" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Name</th> 
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php($counter=1)
                                            @php($index=0)
                                            @forelse($platforms as $platform)
                                                <tr>
                                                    <td>{{ $counter++}}</td>
                                                    <td>{{ $platform->name}} </td>
                                                    <td>
                                                        @if($platform->is_multiple == true)
                                                            <label class="label label-success btn-sm"> Multiple</label>
                                                        @else
                                                            <label class="label label-primary btn-sm"> Single</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($platform->is_active == true)
                                                                <a href="#" data-href="{{ URL::route('platforms.activate', $platform->id) }}" id="remarks{{$index}}" class="label label-success btn-sm"><i class="fa fa-minus-square-o"></i>Active</a>
                                                        @else
                                                            <a href="#" data-href="{{ URL::route('platforms.activate', $platform->id) }}" id="remarks{{$index}}" class="label label-danger btn-sm"><i class="fa fa-minus-square-o"></i>Not Active</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                            <ul class="dropdown-menu pull-left" role="menu">
                                                                <input type="hidden" id="platform_id{{$index}}" value="{{$platform->slug}}">
                                                                <li><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i></a></li>
                                                                <li><a data-href="{{ URL::route('platforms.delete',$platform->id)}}" class="btn_platform_delete"><i class="fa fa-trash"></i></a></li>
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
    </div>
    @include('admin.platforms.modals._new_platforms')
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var ADDPLATFORM = "{{URL::route('platforms.add')}}";
    </script>
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/admin/platform.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('js/pages/dashboard_chart.js') }}" type="text/javascript"></script>
@endsection
