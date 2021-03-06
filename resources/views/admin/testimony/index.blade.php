@extends('admin.partials.app')

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
                        <!--div class="actions">
                            <button class="btn btn-xs green pull-right" data-toggle="modal" data-target="#new-testimony" type="button" ><i class="icon-envelope"></i> Create Testimony</button>
                        </div-->
                    </div>
                    <div class="portlet-body form">
                        @if(count($testimonies) < 1)
                            <center><em>There are no testimonies</em></center>
                        @else
                            <table class="table table-striped table-hover table-bordered testimonies_list" id="sample_2">
                                <thead>
                                    <tr>
<<<<<<< HEAD
                                        <th></th>
=======
                                        <th width="30">S/N</th>
>>>>>>> d877e9e48e10abd16d666944a8104e7b3fea5420
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
                                    @php($counter = 1)
                                    @foreach($testimonies as $testimony)
                                        <tr>
<<<<<<< HEAD
                                            <td>{{ $counter }}</td>
=======
                                            <td>#</td>
>>>>>>> d877e9e48e10abd16d666944a8104e7b3fea5420
                                            <td>{{ $testimony->user->Profile->full_name }}</td>
                                            <td>{{ $testimony->title }}</td>
                                            <td>{{ strip_tags(word_counter($testimony->message, 8,'...')) }}</td>
                                            <td><span class="badge badge-{{ testimony_status($testimony->status,'class') }}">{{ testimony_status($testimony->status,'name') }}</span></td>
<<<<<<< HEAD
                                            <td>{{ $testimony->created_at }}</td>
                                            <td>{{ $testimony->updated_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <input type="hidden" id="testimony_id{{$index}}" value="{{$testimony->slug}}">
                                                        <li><a href="#" data-href="{{ URL::route('testimonies.approve', $testimony->id) }}" id="activate{{$index}}">Approve</li>
                                                        <li><a href="#" data-href="{{ URL::route('testimonies.decline', $testimony->id) }}" id="decline{{$index}}">Decline</li>
=======
                                            <td>{{ $testimony->created_at->diffForHumans() }}</td>
                                            <td>{{ $testimony->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <input type="hidden" id="testimony_id{{$index}}" value="{{$testimony->slug}}">
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button" id="button" data-toggle="dropdown" aria-expanded="false"> Actions<i class="fa fa-angle-down"></i></button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li><a href="#" data-href="{{ URL::route('testimonies.approve', $testimony->id) }}" id="activate{{$index}}"><i class="fa fa-check"></i> Approve</li>
                                                        <li><a href="#" data-href="{{ URL::route('testimonies.decline', $testimony->id) }}" id="decline{{$index}}"><i class="fa fa-close"></i> Decline</li>
>>>>>>> d877e9e48e10abd16d666944a8104e7b3fea5420
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
<<<<<<< HEAD
=======
    <div class="row"></div>
>>>>>>> d877e9e48e10abd16d666944a8104e7b3fea5420
@endsection
@section('modals')
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
<<<<<<< HEAD
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
        tinymce.init({
            selector: '#editor2',
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
=======
    
>>>>>>> d877e9e48e10abd16d666944a8104e7b3fea5420
    <script>
        var SEND = "{{ URL::route('testimonies.add') }}";
        var TOKEN = "{{ csrf_token() }}";
        var GET_DETAILS = "{{ URL::route('testimonies.editInfo') }}";
        var UPDATE = "{{ URL::route('testimonies.update') }}";
    </script>
    <script src="{{ asset('js/pages/testimonies.js') }}"></script>
@endsection
