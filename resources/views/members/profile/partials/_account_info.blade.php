<form role="form" action="#">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Account Name</label>
                <input type="text" id="account_name" value="{{ $profile->account->account_name }}" class="form-control"> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Account Number</label>
                <input type="text" id="account_number" value="{{ $profile->account->account_number }}" class="form-control"> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Bank Name</label>
                <input type="text" id="bank_name" value="{{ $profile->account->bank_name }}" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Bank Code</label>
                <input type="text" id="bank_code" value="{{ $profile->account->bank_code }}" class="form-control"> 
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Sort Code</label>
                <input type="text" id="sort_code" value="{{ $profile->account->sort_code }}" class="form-control"> 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Swift Code</label>
                <input type="text" id="swift_code" value="{{ $profile->account->swift_code }}" class="form-control"> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">IBAN Number</label>
                <input type="text" id="iban_number" value="{{ $profile->account->iban_number }}" class="form-control"> 
            </div>
        </div>
    </div>
    <div class="margiv-top-10">
        @if(auth()->user()->is_admin == 0)
	        @if(isset($profile->account->account_number) && isset($profile->account->account_name) && isset($profile->account->bank_name))
	        @else
	        <img src="{{ asset('images/loader.gif') }}" id="account_loader" /> 
	        <a href="javascript:;" id="update_account_btn" class="btn green" > Save Changes </a>
	        @endif
        @endif
    </div>
</form>