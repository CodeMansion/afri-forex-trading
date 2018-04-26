<div class="form-body">
    <div class="form-group">
        <div class="form-group">
            <label>Name</label><span style="color:red">*</span>
            <input class="form-control" value="{{ $packagetype->name }}" type="text" id="name1" name="name" placeholder="e.g.Platform Name" /> 
            <input class="form-control" value="{{ $packagetype->slug }}" type="hidden" id="slug" /> 
        </div>
        <div class="form-group">
            <label>Type</label><span style="color:red">*</span>
            <input class="form-control" value="{{ $packagetype->percentage }}" type="text" id="percentage1" name="name" placeholder="e.g.Package Type Percentage" />                                
        </div>                            
    </div>
</div>
<button type="button" class="btn green" id="edit-packagetype"><i class="fa fa-plus"></i> Edit Package Type</button>