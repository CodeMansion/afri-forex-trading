@extends('admin.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/icheck/skins/all.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="page-title"> Genenel System Settings <small></small> </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li><span>Settings</span></li>
            <li><span>General System Settings</span></li>
        </ul>
    </div>

    <div class="inbox">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">General System Settings</span>
                        </div>
                        <div class="actions">
                            
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Application Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="application_name" value="{{ $settings['application_name'] }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Motto</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="motto" value="{{ $settings['motto'] }}" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="description" style="height:150px;">{{ $settings['description'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Currency Exchange API</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="exchange_api" value="{{ $settings['currency_exchange_api']}}">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Default Currency</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="default_currency">
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">System Status</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="system_status_id">
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}" <?php echo ($status->id == $settings['system_status_id']) ? "selected" : ""; ?>>{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enable Sound Notification</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <div class="icheck-list" style="margin-top:15px;">
                                                <label><input type="checkbox" class="icheck" id="sound_notification" data-checkbox="icheckbox_square-green" 
                                                <?php echo ($settings['enable_sound_notification']) ? "checked" : ""; ?> ></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enable Push Notification</label>
                                    <div class="col-md-9">
                                        <div class="icheck-list" style="margin-top:15px;">
                                            <label><input type="checkbox" class="icheck" id="push_notification" data-checkbox="icheckbox_square-green" 
                                            <?php echo ($settings['enable_push_notification']) ? "checked" : ""; ?> > </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enable Session Timeout</label>
                                    <div class="col-md-9">
                                        <div class="icheck-list" style="margin-top:15px;">
                                            <label><input type="checkbox" class="icheck" id="session_timeout" data-checkbox="icheckbox_square-green"
                                            <?php echo ($settings['enable_session_timeout']) ? "checked" : ""; ?> > </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enable Login Alert</label>
                                    <div class="col-md-9">
                                        <div class="icheck-list" style="margin-top:15px;">
                                            <label><input type="checkbox" class="icheck" id="login_alert" data-checkbox="icheckbox_square-green" 
                                            <?php echo ($settings['enable_login_email_alert']) ? "checked" : ""; ?> > </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Enable System Backup</label>
                                    <div class="col-md-9">
                                        <div class="icheck-list" style="margin-top:15px;">
                                            <label><input type="checkbox" class="icheck" id="backup" data-checkbox="icheckbox_square-green"
                                            <?php echo ($settings['enable_system_backup']) ? "checked" : ""; ?> > </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">System Logo</label>
                                    <div class="col-md-9">
                                        <input type="file" id="logo" />
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
                                        <button type="button" class="btn green" id="update_general_settings_btn">Update</button>
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
    <script src="{{ asset('assets/global/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('assets/pages/scripts/form-icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
    <script>
        var UPDATE = "{{ URL::route('generalSettingUpdate') }}";
        var TOKEN = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/pages/general_settings.js') }}"></script>
@endsection
