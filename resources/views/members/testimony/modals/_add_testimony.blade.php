<div id="new-testimony" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><span class="icon-envelope font-green"></span> Create New Testimony</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name <span class="required">*</span></label>
                            <input class="form-control" type="text" id="name" value="{{ \Auth::user()->Profile->full_name }}" disabled/> 
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email Address<span class="required">*</span></label>
                            <input class="form-control" type="email" id="email" value="{{ \Auth::user()->email}}" disabled/> 
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Subject <span class="required">*</span></label>
                    <input class="form-control" type="text" id="title"/> 
                </div>
                <div class="form-group">
                    <label>Message <span class="required">*</span></label>
                    <textarea class="form-control" id="test_message"></textarea> 
                </div>
                <hr/>
                <div id="errors"></div> 
                <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
                <button type="button" class="btn green" id="create_new_testimony_btn"> Submit</button>
            </div>
        </div>
    </div>
</div>