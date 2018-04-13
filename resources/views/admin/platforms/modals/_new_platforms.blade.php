<div id="new-platform" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><span class="icon-layers font-green"></span> New Platform</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div id="serverError"></div>
                    <div class="form-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="e.g.Platform Name" /> 
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <select class="form-control" id="is_multiple">
                                    <option value="">-- Select Type --</option>  
                                    <option value="0">Single</option>
                                    <option value="1">Multiple</option>
                                </select>                                
                            </div>                            
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green" id="add-platform"><i class="fa fa-plus"></i> Add Platform</button>
            </div>
            </form>
        </div>
    </div>
</div>