@extends('members.partials.app')
@section('extra_style')
    <link href="{{ asset('assets/pages/css/pricing.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <h1 class="page-title"> 
        <i class="fa fa-dashboard"></i> Hello, <strong>{{ strtoupper(\Auth::user()->full_name) }} | </strong> <small>DASHBOARD</small> 
        <span class="pull-right">
            <i class="fa fa-calendar"></i> <?php echo date('l, F d, Y', strtotime(now())); ?>
        </span>
    </h1>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{ URL::route('packageSub') }}">
                    <span>Services</span>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
            <li><span>Investment Packages</span></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="portlet light " id="form_wizard_1">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red bold uppercase"> Investment Packages
                            <span class="step-title"></span>
                        </span>
                    </div>
                    <div class="actions">
                    <a href="{{ URL::route('packageSub') }}"><button class="btn btn-xs red" type="button"><i class="fa fa-close"></i> Cancel</button></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12"></div>
                        <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
                            <table class="table table-striped text-center table-bordered">
                                <thead style="background-color:#1ABC9C;color:white;text-align: center;">
                                    <tr class="text-center" style="font-size:22px;">
                                        <td width="200">PACKAGES</td>
                                        <td>AMOUNT</td>
                                        <td>MONTHLY CHARGE</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody style="font-size:22px;">
                                    @foreach($packages as $package)
                                        <tr>
                                            <td style="background-color: #138D75;color:white;">{{ strtoupper($package->name) }}</td>
                                            <td>${{ number_format($package->investment_amount, 2) }}</td>
                                            <td>{{ $package->monthly_charge}}%</td>
                                            <td><a href="{{ URL::route('SelectPackageType', $package->slug) }}"><button type="button" class="btn green btn-md uppercase price-button">Select</button></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12"></div>
                    </div>           
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
@endsection
@section('extra_script')
    <script>
        var TOKEN = "{{csrf_token()}}";
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
@endsection
@section('after_script')
    <script src="{{ asset('js/pages/subscription_page.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/pages/scripts/ui-sweetalert.min.js') }}" type="text/javascript"></script>
@endsection