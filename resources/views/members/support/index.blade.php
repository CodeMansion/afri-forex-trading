@extends('members.partials.app')

@section('content')
<div class="row">
    <div class="col-md-8">
    <h1 class="page-title">How to Create Support Ticket</h1>
        <div class="m-heading-1 border-green m-bordered">
            <h3>Bootstrap Context Menu</h3>
            <p> A context menu extension of Bootstrap made for everyone's convenience. For more info please check out
                <a href="https://github.com/sydcanem/bootstrap-contextmenu" target="_blank">the official documentation</a>. 
            </p>
        </div>
        <h1 class="page-title"> Pending Tickets</h1>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <h4 class="font-green-sharp">TICKET REFERENCE NUMBER</h4>
                            <small>TICKET TITLE</small>
                        </div>
                    </div>
                    <hr>
                    <div class="status">
                        <div class="status-title"> Date Created </div>
                        <div class="status-number"> Status </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <h4 class="font-green-sharp">TICKET REFERENCE NUMBER</h4>
                            <small>TICKET TITLE</small>
                        </div>
                    </div>
                    <hr>
                    <div class="status">
                        <div class="status-title"> Date Created </div>
                        <div class="status-number"> Status </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <a class="btn green" href="javascript:;"> 
                <i class="fa fa-plus"></i>
                Create Ticket 
            </a>
        </div>
        <div class="portlet box purple " style="margin-top:1em;">
            <div class="portlet-title" style="background-color:#32c5d2; border-color:#32c5d2;">
                <div class="caption">
                    <i class="fa fa-gift"></i> New Ticket </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal" role="form">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Ticket Title</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="Default Input"> </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Related Support</label>
                            <div class="col-md-9">
                                <select class="form-control">
                                    <option>Option 1</option>
                                    <option>Option 2</option>
                                    <option>Option 3</option>
                                    <option>Option 4</option>
                                    <option>Option 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Complain</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button type="button" class="btn default">Cancel</button>
                        <button type="submit" class="btn green">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-dark"></i>
                    <span class="caption-subject font-dark bold uppercase">Inline Notifications</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="alert alert-block alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <h4 class="alert-heading">Error!</h4>
                    <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </p>
                    <p>
                        <a class="btn red" href="javascript:;"> Do this </a>
                        <a class="btn blue" href="javascript:;"> Cancel </a>
                    </p>
                </div>
                <div class="alert alert-block alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <h4 class="alert-heading">Success!</h4>
                    <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </p>
                    <p>
                        <a class="btn green" href="javascript:;"> Do this </a>
                        <a class="btn btn-link" href="javascript:;"> Cancel </a>
                    </p>
                </div>
                <div class="alert alert-block alert-info fade in">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <h4 class="alert-heading">Info!</h4>
                    <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </p>
                    <p>
                        <a class="btn purple" href="javascript:;"> Do this </a>
                        <a class="btn dark" href="javascript:;"> Cancel </a>
                    </p>
                </div>
                <div class="alert alert-block alert-warning fade in">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <h4 class="alert-heading">Warning!</h4>
                    <p> Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. </p>
                    <p>
                        <a class="btn red" href="javascript:;"> Do this </a>
                        <a class="btn blue" href="javascript:;"> Cancel </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra_script')
    <script src="{{ asset('assets/global/plugins/echarts/echarts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/flot/jquery.flot.pie.min.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ asset('assets/pages/scripts/charts-flotcharts.min.js') }}" type="text/javascript"></script> -->
@endsection
@section('after_script')
    <script src="{{ asset('js/pages/dashboard_chart.js') }}" type="text/javascript"></script>
@endsection