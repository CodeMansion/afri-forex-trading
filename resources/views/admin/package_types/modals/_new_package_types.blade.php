<div id="new-packagetype" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><span class="icon-layers font-green"></span> New Package Type</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div id="serverError"></div>
                    <div class="form-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label>Name</label><span style="color:red">*</span>
                                <input class="form-control" type="text" id="name" name="name" placeholder="e.g.Package Type Name" /> 
                            </div>
                            <div class="form-group">
                                <label>Percentage</label><span style="color:red">*</span>
                                <input class="form-control" type="text" id="percentage" name="name" placeholder="e.g.Package Type Percentage" />                              
                            </div>                            
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn green" id="add-packagetype"><i class="fa fa-plus"></i> Add Package Type</button>
            </div>
            </form>
        </div>
    </div>
</div>