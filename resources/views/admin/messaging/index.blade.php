@extends('admin.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/fancybox/source/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('extra_style_after')
    <link href="{{ asset('assets/apps/css/inbox.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> System Bulk Messaging <small></small> 
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
            <li><span>Bulk Messaging</span></li>
        </ul>
    </div>

    <div class="inbox">
        <div class="row">
            <div class="col-md-2">
                <div class="inbox-sidebar">
                    <a href="javascript:;" id="btn_compose" data-title="Compose" class="btn red compose-btn btn-block">
                        <i class="fa fa-edit"></i> Compose </a>
                    <ul class="inbox-nav">
                        <li><a href="javascript:;" id="btn_sent" class="sbold uppercase" data-type="sent" data-title="Sent"> Sent </a> </li>
                        <li><a href="javascript:;" id="btn_draft" class="sbold uppercase" data-type="draft" data-title="Draft"> Draft<span class="badge badge-danger">8</span></a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:;" id="btn_trash" class="sbold uppercase" data-title="Trash"> Trash<span class="badge badge-info">23</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div id="message_compose">@include('admin.messaging.partials._compose')</div>
                <div id="message_sent">@include('admin.messaging.partials._sent')</div>
                <div id="message_draft">@include('admin.messaging.partials._draft')</div>     
                <div id="message_trash">@include('admin.messaging.partials._trash')</div>     
            </div>
        </div>
    </div>
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/fancybox/source/jquery.fancybox.pack.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <!-- <script src="{{ asset('assets/apps/scripts/inbox.min.js') }}" type="text/javascript"></script> -->
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
        var SEND = "{{ URL::route('msgSend') }}";
        var TOKEN = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/pages/messaging.js') }}"></script>
@endsection
