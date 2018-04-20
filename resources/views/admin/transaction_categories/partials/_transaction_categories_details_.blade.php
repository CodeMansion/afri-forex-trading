<div class="form-body">
    <div class="form-group">
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" value="{{ $transactioncategory->name }}" type="text" id="name1" name="name" placeholder="e.g.Platform Name" /> 
            <input class="form-control" value="{{ $transactioncategory->slug }}" type="hidden" id="slug" /> 
        </div>                           
    </div>
</div>
<button type="button" class="btn green" id="edit-transactioncategories"><i class="fa fa-plus"></i> Edit Transaction Categories</button>