<div class="form-body">
        <div class="form-group">
            <div class="form-group">
                <label>Package Name</label><span style="color:red">*</span>
                <input class="form-control" value="{{ $package->name }}" type="text" id="name1" name="name" placeholder="e.g.Package Name" /> 
                <input class="form-control" value="{{ $package->slug }}" type="hidden" id="slug"/> 
            </div>
            <div class="form-group">
                <label>Platform</label><span style="color:red">*</span>
                <select class="form-control" id="platform_id1">
                    <option value="">-- Select Type --</option>  
                    @forelse($platforms as $platform)
                        <option value="{{ $platform->id }} " <?php echo ($platform['id'] == $package->platform_id) ? "selected" : ""; ?>>{{ $platform->name }} </option>
                    @empty
                        <option value="">-- No Platform Available<a href="{{ URL::route('platforms.index')}} " >click to add platform</a> --</option>
                    @endforelse
                </select>                                
            </div> 
            <div class="form-group">
                <label>Package Investment Amount</label><span style="color:red">*</span>
                <input value="{{ $package->investment_amount }}" class="form-control" type="text" id="investment_amount1" name="name" placeholder="e.g.Package Investment Amount" /> 
            </div>
            <div class="form-group">
                <label>Package Investment Monthly Charge</label><span style="color:red">*</span>
                <input value="{{ $package->monthly_charge }}" class="form-control" type="text" id="monthly_charge1" name="name" placeholder="e.g.Package Investment Monthly Charge" /> 
            </div>                           
        </div>
    </div>
<button type="button" class="btn green" id="edit-package"><i class="fa fa-plus"></i> Edit Package</button>