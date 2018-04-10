<div id="platform" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <!--button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button-->
                <h4 class="modal-title"><span class="icon-layers font-green"></span>&nbsp;Platform</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div id="errors"></div>
                    <div class="form-body">
                        <div class="form-group">                            
                            <div class="form-group">
                                <label>Platform</label>
                                <select class="form-control" id="platform_id">
                                    <option value="">-- Select Platform  --</option>
                                    @forelse($platforms as $platform)
                                        <option value="{{ $platform->id}}">{{ $platform->name}} </option>
                                    @empty
                                        <option value="">-- No Active Platform --</option>
                                    @endforelse
                                </select>
                            </div>
                            <div id="packages">
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn green" id="subscribe_pay"><i class="fa fa-plus"></i>Pay</button>
                        <button type="button" class="btn green" id="investment_pay"><i class="fa fa-plus"></i>Pay</button>
                    </div>
                </form>
        </div>
    </div>
</div>