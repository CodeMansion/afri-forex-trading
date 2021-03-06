<div class="table">
    @if(count($investments) < 1)
        <center> <em>You have no investment</em></center>
    @else 
    <table class="table table-striped table-hover table-bordered" id="sample_2">
        <thead>
            <tr>
                <th width="30">S/N</th>
                <th>PACKAGE</th>
                <th>TYPE</th>
                <th>AMOUNT</th>
                <th>EARNING AMOUNT</th>
                <th>STATUS</th>
                <th>DATE</th>
            </tr>
        </thead>
        <tbody>
            @php($counter=1)
            @foreach($investments as $investment)
                <tr>
                    <td>{{$counter}}</td>
                    <td>{{ $investment->Package->name }} </td>                      
                    <td>{{ $investment->PackageType->name}}</td>
                    <td>${{ number_format($investment->Package->investment_amount,2) }}</td>
                    <td>${{ number_format($investment->Package->earnings,2) }}</td>
                    <td><span class="badge badge-{{ investment_status($investment->status,'class') }}">{{ investment_status($investment->status,'name') }}</span></td>
                    <td>{{ $investment->created_at }}</td>
                </tr>
            @php($counter++)
            @endforeach
        </tbody>
    </table>
    @endif
</div>