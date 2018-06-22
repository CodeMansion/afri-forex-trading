@extends('admin.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-bars"></i> Services <small></small> 
        <span class="pull-right">
            <i class="fa fa-calendar"></i> <?php echo date('l, F d, Y', strtotime(now())); ?>
        </span>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Services</span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Services </span>
                <span class="caption-helper">Displaying list of system services </span>                        
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a class="font-white btn green btn-xs" data-toggle="modal" data-target="#new-platform" title="Add">
                        <i class="fa fa-plus"></i> New Service
                    </a>
                </div>
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            @if(count($platforms) < 1)
                                <center><em>There are no services</em></center>
                            @else 
                                <table class="table table-striped table-hover platforms" id="sample_2">
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
                                        @foreach($platforms as $platform)
                                            <tr>
                                                <td>{{ $counter}}</td>
                                                <td>{{ $platform->name}} </td>
                                                <td>
                                                    @if($platform->is_multiple == true)
                                                        <label class="label label-success btn-sm"> Multiple</label>
                                                    @else
                                                        <label class="label label-primary btn-sm"> Single</label>
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-{{ ($platform->is_active) ? 'success' : 'danger' }}">{{ ($platform->is_active) ? 'Active' : 'Inactive' }}</span></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                        <ul class="dropdown-menu pull-left" role="menu">
                                                            <input type="hidden" id="platform_id{{$index}}" value="{{$platform->slug}}">
                                                            <li><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i>Edit</a></li>
                                                            <li><a href="{{ URL::route('platforms.show',$platform->slug) }}"><i class="icon-note"></i> View Users</a></li>
                                                            <li><a data-href="{{ URL::route('platforms.delete',$platform->slug)}}" id="btn_platform_delete{{$index}}"><i class="fa fa-trash"></i> Delete</a></li>
                                                            @if($platform->is_active == true)
                                                            <li><a href="#" data-href="{{ URL::route('platforms.activate', $platform->id) }}" id="deactivate{{$index}}"><i class="fa fa-minus-square-o"></i> Active</a></li>
                                                            @else
                                                            <li><a href="#" data-href="{{ URL::route('platforms.activate', $platform->id) }}" id="activate{{$index}}"><i class="fa fa-minus-square-o"></i> Not Active</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php($index++)
                                        @php($counter++)
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    @include('admin.platforms.modals._new_platforms')
    @include('admin.platforms.modals._edit_platforms')
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var UPDATE_URL = "{{URL::route('platforms.update')}}";
        var GET_EDIT_INFO = "{{URL::route('platforms.editInfo')}}";
        var ADDPLATFORM = "{{URL::route('platforms.add')}}";
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" ="text/javascript"></script>
    
    <script src="{{ asset('assets/pages/admin/platform.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection
