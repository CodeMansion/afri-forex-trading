<div id="make_withdrawal" class="modal fade" tabindex="-1" data-backdrop="static" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button
                <h4 class="modal-title"><span class="icon-layers font-green"></span>&nbsp;Withdrawal Request</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-info"> Please note that the minimum wallet balance is $10.00 and 5% charge for every withdrawal.</div><hr/>
                <form action="#">
                    <div class="" style="font-size: 16px;">
                        <center>
                            <span style="color:red;"><b>Ledger Balance:</b> ${{ number_format($balance, 2) }}</span><br/>
                            <span><b>Available Balance:</b> ${{ number_format($balance - 10.00, 2) }}</span>
                        </center>
                    </div><hr/>
                    <div class="form-group">
                        <input type="number" style="font-size: 18px;height:40px;" class="form-control" step="0.01" id="amount" placeholder="Enter withdrawal amount"/> 
                    </div>
                    <hr/>
                    <div class="margin-top-10">
                        <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
                        <a href="javascript:;" id="make_withdrawal_btn" class="btn green"> Withdraw</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>