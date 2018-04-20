@extends('admin.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="page-title"> Mail Settings <small></small> </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Settings</span></li>
            <li><span>Mail Settings</span></li>
        </ul>
    </div>

    <div class="inbox">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Out-going Mail Settings</span>
                        </div>
                        <div class="actions">
                            
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mail Host</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="mail_host" value="{{ $mailing['host'] }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Host Username</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="host_username" value="{{ $mailing['username'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Host Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="host_password" value="{{ $mailing['password'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Host Port</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" id="host_port" value="{{ $mailing['port'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mail Encryption</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="mail_encryption">
                                            <option name="none" <?php ($mailing['encryption'] == 'none') ? "selected" : ""; ?> >None</option>
                                            <option name="tls" <?php ($mailing['encryption'] == 'tls') ? "selected" : ""; ?>>TLS</option>
                                            <option name="ssl" <?php ($mailing['encryption'] == 'ssl') ? "selected" : ""; ?>>SSL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sender Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="sender_name" value="{{ $mailing['from_name'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sender Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="sender_email" value="{{ $mailing['from_email'] }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Reply To</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="reply_to" value="{{ $mailing['reply_to'] }}">
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
                                        <button type="button" class="btn green" id="update_mail_settings_btn">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        var UPDATE = "{{ URL::route('mailUpdate') }}";
        var TOKEN = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/pages/mail_settings.js') }}"></script>
@endsection
