@extends('admin.partials.app')

@section('extra_style')
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <h1 class="page-title"> Dispute - {{ $dispute->ticket_no }} <small></small> </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <i class="icon-envelope"></i>
                <a href="{{ URL::route('disputeIndex') }}">Disputes</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>{{ $dispute->ticket_no }}</span></li>
        </ul>
    </div>

    <div class="inbox" style="height: 100%;">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-envelope font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">{{ $dispute->ticket_no }}</span>
                            <span class="badge badge-{{ dispute_status($dispute->status,'class') }}">{{ dispute_status($dispute->status,'name') }}</span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel">
                                    <div class="mt-element-list">
                                        <div class="mt-list-head list-news font-white bg-blue">
                                            <div class="list-head-title-container">
                                                <h4 class="list-title">Ticket Information</h4>
                                            </div>
                                        </div>
                                        
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                {{ $dispute->title }} 
                                                <span class="badge badge-{{ dispute_status($dispute->status,'class') }}">{{ dispute_status($dispute->status,'name') }}</span>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Submitted:</strong><br/>
                                                {{ $dispute->created_at }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Last Updated:</strong><br/>
                                                {{ $dispute->updated_at }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Priority:</strong><br/>
                                                {{ $dispute->priority->name }}
                                            </li>
                                        </ul>
                                        <div class="panel-footer">
                                            @if($dispute->status == 2)
                                            @else
                                                <button class="btn btn-sm btn-success" type="button" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"><i class="fa fa-pencil"></i> Reply</button>
                                                <button class="btn btn-sm btn-warning" id="resolve_dispute_btn" type="button"><i class="fa fa-check"></i> Mark As Resolve</button>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-7'>
                                @if($dispute->status == 2)
                                @else
                                <div class="panel-group accordion" id="accordion3">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"><i class="fa fa-pencil"></i> Reply </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_3_1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Name <span class="required">*</span></label>
                                                                <input class="form-control" type="text" id="name" value="{{ \Auth::user()->full_name }}" disabled/> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Email Address<span class="required">*</span></label>
                                                                <input class="form-control" type="email" id="email" value="{{ \Auth::user()->email}}" disabled/> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Message <span class="required">*</span></label>
                                                        <textarea class="form-control" style="height:50px;" id="editor1"></textarea> 
                                                    </div> <hr/>
                                                    <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
                                                    <input type="hidden" value="{{ $dispute->id }}" id="dispute_id" />
                                                    <button type="button" class="btn green" id="reply_dispute_btn"> Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <i class="fa fa-user"></i> <strong>{{ $dispute->user->full_name }}</strong> ({{ $dispute->ticket_no }}) 
                                            <span class="pull-right" style="font-size:12px;">{{ $dispute->created_at }}</span>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo htmlspecialchars_decode($dispute->message); ?>
                                    </div>
                                </div>

                                @foreach($replies as $reply)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <i class="fa fa-user"></i> <strong>{{ $reply->user->full_name }}</strong>
                                            <span class="pull-right" style="font-size:12px;">{{ $reply->created_at }}</span>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo htmlspecialchars_decode($reply->message); ?>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>   
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>
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
        var REPLY = "{{ URL::route('replyDispute') }}";
        var TOKEN = "{{ csrf_token() }}";
        var RESOLVE = "{{ URL::route('resolveDispute') }}";
    </script>
    <script src="{{ asset('js/pages/disputes.js') }}"></script>
@endsection
