<div id="new-admin-member" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><span class="icon-layers font-green"></span> New Administrator</h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input class="form-control" type="text" id="full_name" name="full_name" /> 
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" id="username" name="username" /> 
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="form-control" type="email" id="email" name="email" /> 
                    </div>
                    <div class="form-group">
                        <label>Telephone</label>
                        <input class="form-control" type="text" id="telephone" name="telephone" /> 
                    </div>
                    <div class="form-group">
                        <label>Administrator Role</label>
                        <select class="form-control" id="role_id">
                            <option value="">-- Select Role --</option>  
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ strtoupper($role->name) }}</option>
                            @endforeach
                        </select>                                
                    </div> 
                </div><hr/>
                <div class="form-group">
                    <img src="{{ asset('images/loader.gif') }}" id="loader" />
                    <button type="button" class="btn green" id="create_admin_btn"><i class="fa fa-plus"></i> Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>