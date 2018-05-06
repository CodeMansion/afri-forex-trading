@extends('members.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>testimony</small> 
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
            <li><span>Testimony</span></li>
        </ul>
    </div>

    <div class="inbox">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-envelope font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">List of Testimony</span>
                        </div>
                        <div class="actions">
                            <button class="btn btn-xs green pull-right" data-toggle="modal" data-target="#new-testimony" type="button" ><i class="icon-envelope"></i> Create Testimony</button>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        @if(count($testimonies) < 1)
                            <center><em>There are no testimonies</em></center>
                        @else
                            <table class="table table-striped table-bordered table-hover table-bordered testimonies_list" id="sample_2">
                                <thead>
                                    <tr>
                                        <th width="50"></th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($index=0)
                                    @php($counter = 1)
                                    @foreach($testimonies as $testimony)
                                        <tr>
                                            <td>#</td>
                                            <td>{{ $testimony->title }}</td>
                                            <td>{{ strip_tags(word_counter($testimony->message, 8,'...')) }}</td>
                                            <td><span class="badge badge-{{ testimony_status($testimony->status,'class') }}">{{ testimony_status($testimony->status,'name') }}</span></td>
                                            <td>{{ $testimony->created_at->diffForHumans() }}</td>
                                            <td>{{ $testimony->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <input type="hidden" id="testimony_id{{$index}}" value="{{$testimony->slug}}">
                                                        <li><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i>Edit</a></li>
                                                        <li><a data-href="{{ URL::route('testimonies.delete',$testimony->slug)}}" id="btn_testimony_delete{{$index}}"><i class="fa fa-trash"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @php($counter++)
                                    @php($index++)
                                    @endforeach
                                </tbody>
                            </table>
                        @endif                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    @include('members.testimony.modals._add_testimony')
    @include('members.testimony.modals._edit_testimony')
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
    
    <script>
        var SEND = "{{ URL::route('testimonies.add') }}";
        var TOKEN = "{{ csrf_token() }}";
        var GET_DETAILS = "{{ URL::route('testimonies.editInfo') }}";
        var UPDATE = "{{ URL::route('testimonies.update') }}";
    </script>
    <script src="{{ asset('js/pages/testimonies.js') }}"></script>
@endsection
