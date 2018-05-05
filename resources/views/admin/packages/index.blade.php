@extends('admin.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="icon-wallet"></i> Packages<small></small> 
        <span class="pull-right">
            <i class="fa fa-calendar"></i> <?php echo date('l, F d, Y', strtotime(now())); ?>
        </span>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{ URL::route('dashboard') }} ">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Packages</span></li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <div class="portlet light tasks-widget bordered">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-haze bold uppercase">Packages </span>
                <span class="caption-helper">Displaying list of Packages </span>                        
            </div>
            <div class="actions">
                <div class="btn-group">
                    <a class="font-white btn green pull btn-xs pull-left" data-toggle="modal" data-target="#new-package" title="Add"><i class="icon-plus"></i> Create Package</a>
                </div>
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="packages">
                            @if(count($packages) < 1)
                                <center>
                                        <em>There are no package </em>
                                </center>
                            @else 
                                <table class="table table-bordered table-striped table-hover packages" id="sample_3">
                                    <thead>
                                        <tr>
                                            <th width="50">S/N</th>
                                            <th>NAME</th>
                                            <th width="100">AMOUNT</th>
                                            <th width="100">MONTHLY CHARGE</th>
                                            <th width="100">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($counter=1)
                                        @php($index=0)
                                        @forelse($packages as $package)
                                            <tr>
                                                <td>#</td>
                                                <td>{{ strtoupper($package->name) }} </td>
                                                <td>${{ number_format($package->investment_amount,2) }} </td>
                                                <td>${{ number_format($package->monthly_charge,2) }} </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                        <ul class="dropdown-menu pull-left" role="menu">
                                                            <input type="hidden" id="package_id{{$index}}" value="{{$package->slug}}">
                                                            <li><a href="javascript:;" id="edit{{$index}}"><i class="icon-note"></i> Edit</a></li>
                                                            <li><a data-href="{{ URL::route('packages.delete',$package->slug)}}" id="btn_package_delete{{$index}}"><i class="fa fa-trash"></i> Delete</a></li>
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
@endsection
@section('modals')
    @include('admin.packages.modals._new_packages')
    @include('admin.packages.modals._edit_packages')
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
        var UPDATE_URL = "{{URL::route('packages.update')}}";
        var GET_EDIT_INFO = "{{URL::route('packages.editInfo')}}";
        var ADDPLATFORM = "{{URL::route('packages.add')}}";
    </script>
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" ="text/javascript"></script>
    <script src="{{ asset('assets/pages/admin/package.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" ="text/javascript"></script>
@endsection
