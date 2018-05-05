<form role="form" action="#">
    <div class="form-group">
        <label class="control-label">Full Name</label>
        <input type="text" placeholder="Full Name" id="full_name" value="{{ $profile['full_name'] }}" class="form-control" /> 
    </div>
    <div class="form-group">
        <label class="control-label">Email Address</label>
        <input type="email" placeholder="Email Address" id="email" value="{{ $profile['email'] }}" class="form-control" disabled/> 
    </div>
    <div class="form-group">
        <label class="control-label">Username</label>
        <input type="email" placeholder="Username" id="username" value="{{ $profile['username'] }}" class="form-control" disabled/> 
    </div>
    <div class="form-group">
        <label class="control-label">Telephone</label>
        <input type="text" placeholder="Telephone" id="telephone" value="{{ $profile->Profile['telephone'] }}" class="form-control" /> 
    </div><hr/>
    <div class="margiv-top-10">
        <a href="javascript:;" id="update_profile_btn" class="btn green"> Save Changes </a>
    </div>
</form>