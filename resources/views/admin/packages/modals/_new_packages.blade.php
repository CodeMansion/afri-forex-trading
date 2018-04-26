<div id="new-package" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><span class="icon-layers font-green"></span> New Package</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div id="serverError"></div>
                    <div class="form-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Package Name</label><span style="color:red">*</span>
                                <input class="form-control" type="text" id="name" name="name" placeholder="e.g.Package Name" /> 
                            </div>
                            <div class="form-group">
                                <label>Platform</label><span style="color:red">*</span>
                                <select class="form-control" id="platform_id">
                                    <option value="">-- Select Type --</option>  
                                    @forelse($platforms as $platform)
                                        <option value="{{ $platform->id }} ">{{ $platform->name }} </option>
                                    @empty
                                        <option value="">-- No Platform Available<a href="{{ URL::route('platforms.index')}} " >click to add platform</a> --</option>
                                    @endforelse
                                </select>                                
                            </div> 
                            <div class="form-group">
                                <label>Package Investment Amount</label><span style="color:red">*</span>
                                <input class="form-control" type="text" id="investment_amount" name="name" placeholder="e.g.Package Investment Amount" /> 
                            </div>
                            <div class="form-group">
                                <label>Package Investment Monthly Charge</label><span style="color:red">*</span>
                                <input class="form-control" type="text" id="monthly_charge" name="name" placeholder="e.g.Package Investment Monthly Charge" /> 
                            </div>                           
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green" id="add-package"><i class="fa fa-plus"></i> Add Package</button>
            </div>
            </form>
        </div>
    </div>
</div>