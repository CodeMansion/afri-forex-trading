@if(count($activities) < 1)
    <center><em>You don't have any activity at the moment</em></center>
@else 
    <table class="table table-bordered table-hover activitylogs" id="sample_2">
        <thead>
            <tr>
                <th>S/N</th>
                <th>MY ACTIONS</th>
                <th>DATE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        	@php($counter=1)
            @foreach($activities as $activity)
            <tr>
                <td>{{$counter}}</td>
                <td>{{ $activity->action }}</td>
                <td>{{ $activity->created_at }}</td>
                <td></td>
            </tr>
            @php($counter++)
            @endforeach
        </tbody>
    </table>
@endif