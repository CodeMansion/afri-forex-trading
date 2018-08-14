@if(count($activities) < 1)
    <center><em>You don't have any activity at the moment</em></center>
@else 
    <table class="table table-bordered table-hover activitylogs">
        <thead>
            <tr>
                <th width="40">S/N</th>
                <th>MY ACTIONS</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @php($count=1)
            @foreach($activities as $activity)
            <tr>
                <td>{{$count}}</td>
                <td>{{ $activity->action }}</td>
                <td>{{ $activity->created_at }}</td>
            </tr>
            @php($count++)
            @endforeach
        </tbody>
    </table>
@endif