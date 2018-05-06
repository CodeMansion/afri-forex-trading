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
    <input class="form-control" type="text" id="title1" value="{{ $testimony->title }}"/> 
    <input class="form-control" type="hidden" id="slug" value="{{ $testimony->slug }}"/>
</div>
<div class="form-group">
    <label>Message <span class="required">*</span></label>
    <textarea class="form-control" id="message1">{{ strip_tags($testimony->message) }}</textarea> 
</div>
<hr/>
<div id="errors1"></div> 
<button type="button" class="btn green" id="update_testimony_btn"> Update</button>