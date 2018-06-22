@extends('members.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>DISPUTE</small> 
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
                            <button class="btn btn-xs green pull-right" data-toggle="modal" data-target="#new-dispute" type="button" ><i class="icon-envelope"></i> Open Ticket</button>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        @if(count($disputes) < 1)
                            <center><em>There are no disputes</em></center>
                        @else
                            <table class="table table-striped table-hover table-bordered disputes_list" id="sample_2">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Member</th>
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
                                    @php($counter=1)
                                    @foreach($disputes as $dispute)
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{ $dispute->user->Profile->full_name }}</td>
                                            <td>{{ $dispute->title }}</td>
                                            <td>{{ strip_tags(word_counter($dispute->message, 8,'...')) }}</td>
                                            <td><span class="badge badge-{{ dispute_status($dispute->status,'class') }}">{{ dispute_status($dispute->status,'name') }}</span></td>
                                            <td>{{ $dispute->created_at }}</td>
                                            <td>{{ $dispute->updated_at }}</td>
                                            <td><a href="{{ URL::route('viewDispute', $dispute->slug) }}"><i class="icon-note"></i> View </a></td>
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
@endsection
@section('modals')
    @include('members.support.modals._support_ticket')
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
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script> 
    <script>
        tinymce.init({
            selector: '#editor1',
            height: 300,
            theme: 'modern',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount spellchecker imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
            image_advtab: true,
            templates: [
              { title: 'Test template 1', content: 'Test 1' },
              { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
              '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
              '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
    <script>
        var SEND = "{{ URL::route('disputeAdd') }}";
        var TOKEN = "{{ csrf_token() }}";
        var GET_DETAILS = "{{ URL::route('getDispute') }}";
    </script>
    <script src="{{ asset('js/pages/disputes.js') }}"></script>
@endsection
