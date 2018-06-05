<div id="refund-wallet" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><span class="icon-layers font-green"></span> Refund Member Wallet</h4>
            </div>
            <div class="modal-body">
                <div id="password_div">
                    <div class="alert alert-warning">
                        Please enter your administrator password to continue
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <input class="form-control" type="password" id="password" name="password" placeholder="Enter password" style="height: 40px;font-size;18px;"/> 
                        </div>
                    </div><hr/>
                    <div class="form-group">
                        <img src="{{ asset('images/loader.gif') }}" id="password_loader" />
                        <button type="button" class="btn green" id="create_confirm_password"> Proceed</button>
                    </div>
                </div>
                <div id="wallet_div">
                    <div class="alert alert-info">
                        Provide amount you wish to transfer to member wallet. Amount must be valid
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <input class="form-control" step="0.01" type="number" id="amount" name="amount" placeholder="Enter amount" style="height: 40px;font-size;18px;"/> 
                        </div>
                    </div><hr/>
                    <div class="form-group">
                        <img src="{{ asset('images/loader.gif') }}" id="wallet_loader" />
                        <input type="hidden" id="user_id" value="{{ $profile['id'] }}" />
                        <button type="button" class="btn green" id="wallet_refund_btn"> Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>