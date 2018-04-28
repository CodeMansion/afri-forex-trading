<div id="change_password" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button
                <h4 class="modal-title"><span class="icon-layers font-green"></span>&nbsp;Change My Password</h4>
            </div>
            <div class="modal-body">
            <div id="errors"></div>
                <form action="#">
                    <div class="form-group">
                        <label class="control-label">Old Password</label>
                        <input type="password" class="form-control" id="old_password" placeholder="Enter Old Password"/> 
                    </div>
                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" Placeholder="Enter New Password"/> 
                    </div>
                    <div class="form-group">
                        <label class="control-label">Re-type New Password</label>
                        <input type="password" class="form-control" id="confirm_new_password" placeholder="Confirm New Password"/> 
                    </div><hr/>
                    <div class="margin-top-10">
                        <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
                        <a href="javascript:;" id="change_password_btn" class="btn green"> Change Password </a>
                        <a href="javascript:;" class="btn default" data-dismiss="modal" aria-hidden="true"> Cancel </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>