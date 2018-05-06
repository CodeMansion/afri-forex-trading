<div class="inbox-body">
    <div class="inbox-header">
        <h1 class="pull-left">Compose</h1>
        <form class="form-inline pull-right" action="index.html">
            <div class="input-group input-medium">
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                    <button type="submit" class="btn green">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    </div><hr/>
    <div id="message_parent"> 
        <form class="inbox-compose form-horizontal" id="fileupload" action="#" method="POST" enctype="multipart/form-data">
            <div id="errorMsg"></div>
            <div class="inbox-form-group mail-to">
                <label class="control-label">Type:</label>
                <div class="controls controls-to">
                    <select class="form-control" id="type" style="border: 0;">
                        <option value="">--recipient type--</option>
                        <option value="individuals">Individuals</option>
                        <option value="ds_members">Daily Signal Subscribers</option>
                        <option value="all_members">All Members</option>
                    </select>
                    <!-- <span class="inbox-cc-bcc">
                        <span class="inbox-cc" id="btn_cc"> Cc </span>
                        <span class="inbox-bcc" id="btn_bcc"> Bcc </span>
                    </span> -->
                </div>
            </div>
            <div class="inbox-form-group mail-to" id="show_individuals">
                <label class="control-label">To:</label>
                <div class="controls controls-to">
                    <input type="text" class="form-control" name="to" id="to">
                </div>
            </div>
            <!-- <div class="inbox-form-group input-cc" id="show_cc">
                <a href="javascript:;" class="close"> </a>
                <label class="control-label">Cc:</label>
                <div class="controls controls-cc">
                    <input type="text" name="cc" id="cc" class="form-control"> 
                </div>
            </div>
            <div class="inbox-form-group input-bcc" id="show_bcc">
                <a href="javascript:;" class="close"> </a>
                <label class="control-label">Bcc:</label>
                <div class="controls controls-bcc">
                    <input type="text" name="bcc" id="bcc" class="form-control"> 
                </div>
            </div> -->
            <div class="inbox-form-group">
                <label class="control-label">Subject:</label>
                <div class="controls">
                    <input type="text" class="form-control" name="subject" id="subject"> 
                </div>
            </div>
            <div class="inbox-form-group">
                <textarea class="inbox-editor inbox-wysihtml5 form-control" id="editor1" name="message" rows="18"></textarea>
            </div>

            <div class="inbox-compose-btn">
                <img src="{{ asset('images/loader.gif') }}" id="loader" /> 
                <button class="btn green" id="send_message" type="button"><i class="fa fa-send"></i>Send</button>
                <!-- <button class="btn default" id="discard">Discard</button>
                <button class="btn default" id="draft">Draft</button> -->
            </div>
        </form>
    </div>
</div>
