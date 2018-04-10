<div class="form-body">
    <div class="form-group">
        <div class="form-group">
            <label>Store Type Name</label>
            <input class="form-control" type="text" id="name1" value="{{$store->name}}" placeholder="e.g. Name" /> 
        </div>
            <input class="form-control" type="hidden" id="slug1" value="{{$store->slug}}" placeholder="e.g. Name" /> 
        <div class="form-group">
            <label>Store Type Code</label>
            <input class="form-control" type="text" id="code1" value="{{$store->code}}" placeholder="e.g. Name" />   
        </div>
        
    </div>
</div>
<button type="button" class="btn green" id="edit-store-type"><i class="fa fa-plus"></i> Edit Store Type</button>