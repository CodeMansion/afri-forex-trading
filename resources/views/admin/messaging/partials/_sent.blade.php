<div class="inbox-body">
    <div class="inbox-header">
        <h1 class="pull-left">Sent Messages</h1>
    </div><hr/>
    <div class="inbox-"> 
        @if(count($sentMessages) < 1)
            <center><em>There are no sent messages</em></center>
        @else
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Type</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sentMessages as $message)
                <tr class="unread" data-messageid="1">
                    <td class="inbox-small-cells">
                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                            <input type="checkbox" class="mail-checkbox" value="1" />
                            <span></span>
                        </label>
                    </td>
                    <td class="view-message hidden-xs"> {{ $message['type'] }} </td>
                    <td class="view-message "> {{ $message['subject'] }} </td>
                    <td><?php echo word_counter(htmlspecialchars_decode($message['message']), 15); ?> ...</td>
                    <td class="view-message text-right"> {{ $message->created_at->diffForHumans()}} </td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>