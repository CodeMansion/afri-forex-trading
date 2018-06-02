@if(count($members) < 1)
    <center><em>There are no members</em></center> 
@else 
    <table class="table table-bordered table-hover members" id="sample_2">
        <thead>
            <tr>
                <th>#</th>
                <th>NAME</th> 
                <th>EMAIL</th>
                <th>USERNAME</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @php($index=0)
            @foreach($members as $member)
                <tr>
                    <td>#</td>
                    <td>{{ $member->full_name}} </td>
                    <td>{{ $member->email}} </td>
                    <td>{{ $member->username}}</td>
                    <td><span class="badge badge-{{ member_status($member->is_active,'class') }}">{{ member_status($member->is_active,'name') }}</span></td>
                    <td>
                        <input type="hidden" id="member_slug_{{ $index }}" value="{{$member->slug}}" />
                        <a href="{{ URL::route('showMember', $member->slug) }}"><i class="icon-note"></i> Manage</a> |
                        <a style="color:red;" href="javascript:;" id="delete_member_{{ $index }}"><i class="icon-trash"></i> Delete</a>
                    </td>
                </tr>
            @php($index++)
            @endforeach
        </tbody>
    </table>
@endif