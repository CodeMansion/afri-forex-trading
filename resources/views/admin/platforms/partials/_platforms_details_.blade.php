<div class="form-body">
    <div class="form-group">
        <div class="form-group">
            <label>Name</label><span style="color:red">*</span>
            <input class="form-control" value="{{ $platform->name }}" type="text" id="name1" name="name" placeholder="e.g.Platform Name" /> 
            <input class="form-control" value="{{ $platform->slug }}" type="hidden" id="slug" /> 
        </div>
        <div class="form-group">
            <label>Type</label><span style="color:red">*</span>
            <select class="form-control" id="is_multiple1">
                <option value="">-- Select Type --</option>  
                <option value="0" <?php echo ($platform['is_multiple'] == 0) ? "selected" : ""; ?>>Single</option>
                <option value="1" <?php echo ($platform['is_multiple'] == 1) ? "selected" : ""; ?>>Multiple</option>
            </select>                                
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" value="{{ $platform->price }}" type="text" id="price1" name="price" placeholder="e.g. 128" /> 
        </div>  
        <div class="form-group">
            <label>ReCycle Price</label>
            <input class="form-control" value="{{ $platform->recycle_price }}" type="text" id="recycle_price1" name="recycle_price" placeholder="e.g. 70" /> 
        </div>                             
    </div>
</div>
<button type="button" class="btn green" id="edit-platform"><i class="fa fa-plus"></i> Edit Platform</button>