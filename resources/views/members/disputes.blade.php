@extends('admin.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> Disputes <small></small> </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Disputes</span></li>
        </ul>
    </div>

    <div class="inbox">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-envelope font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">List of Disputes</span>
                        </div>
                        <div class="actions">
                            
                        </div>
                    </div>
                    <div class="portlet-body form">
                        @if(count($disputes) < 1)
                            <center><em>There are no disputes</em></center>
                        @else
                            <table class="table table-striped table-advance table-hover">
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($disputes as $dispute)
                                    <tr></tr>
                                @endforeach
                            </table>
                        @endif                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
    <script>
        var SEND = "{{ URL::route('msgSend') }}";
        var TOKEN = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/pages/disputes.js') }}"></script>
@endsection
