<div class="form-body">
    <div class="form-group">
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" value="{{ $platform->name }}" type="text" id="name1" name="name" placeholder="e.g.Platform Name" /> 
            <input class="form-control" value="{{ $platform->slug }}" type="hidden" id="slug" /> 
        </div>
        <div class="form-group">
            <label>Type</label>
            <select class="form-control" id="is_multiple1">
                <option value="">-- Select Type --</option>  
                <option value="0" <?php echo ($platform['is_multiple'] == 0) ? "selected" : ""; ?>>Single</option>
                <option value="1" <?php echo ($platform['is_multiple'] == 1) ? "selected" : ""; ?>>Multiple</option>
            </select>                                
        </div>                            
    </div>
</div>
<button type="button" class="btn green" id="edit-platform"><i class="fa fa-plus"></i> Edit Platform</button>