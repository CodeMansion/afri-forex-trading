<div class="table">
    @if(count($downlines) < 1)
        <center> <em>You have no downlines</em></center>
    @else 
    <table class="table table-striped table-hover table-bordered" id="sample_2">
        <thead>
            <tr>
                <th>#</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>USERNAME</th>
                <th>STATUS</th>
                <th>REGISTERED</th>
            </tr>
        </thead>
        <tbody>
            @foreach($downlines as $downline)
                <tr>
                    <td>#</td>
                    <td>{{ $downline->User->username}} </td>   
                    <td>{{ $downline->User->email }}</td>                                                 
                    <td>{{ $downline->User->full_name}}</td>
                    <td>
                        @if($downline->is_active == 1)
                            <label class="badge label-success"> Active</label>
                        @else
                            <label class="badge label-danger"> Inactive</label>
                        @endif
                    </td>
                    <td>{{ $downline->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>