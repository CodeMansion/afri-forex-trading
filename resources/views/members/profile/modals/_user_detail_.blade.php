<div class="col-md-5">
    <div class="profile">
        <img src="{{ asset('images/avatar_default.jpg') }}" class="img-responsive" alt="">        
    </div>                     
</div>
<div class="col-md-7" style="margin-bottom:10px;">
    <label class="control-label">{{ $detail->full_name }}</label><br/>
    <label class="control-label">{{ $detail->username }}</label><br/>
    <label class="control-label">{{ $detail->email }}</label><br/>
    <label class="control-label">{{ $detail->Profile->telephone }}</label><br/>
</div>
<label class="pull-right control-label text-danger" style="margin-bottom:10px;"><span class="text-success">Wallet Balance</span>: ${{ (number_format(auth()->user()->UserWallet->amount,2)) ? number_format(auth()->user()->UserWallet->amount,2) : 0.00 }}</label>
<input id="receiver_user_id" type="hidden" class="form-control" value="{{ $detail->id }}" />
<input id="amount_to_transfer" type="number" class="form-control" placeholder="Enter Fund to share" /> 
                        