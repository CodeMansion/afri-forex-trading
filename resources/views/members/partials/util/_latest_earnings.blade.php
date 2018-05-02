@if(count($earnings) < 1)
    <center><em>There are no recent earnings</em></center>
@else
<div class="table-scrollable table-scrollable-borderless">
    <table class="table table-hover table-light">
        <thead>
            <tr class="uppercase">
                <th> TYPE </th>
                <th> SERVICE </th>
                <th> AMOUNT </th>
                <th> DATE </th>
            </tr>
        </thead>
        <tbody>
            @foreach($earnings as $earning)
                <tr>
                    <td>{{ $earning->type->name }}</td>
                    <td><span class="badge badge-success"> {{ $earning->platform->name }} </span> </td>
                    <td>${{ number_format($earning->amount,2) }}</td>
                    <td><span class="bold theme-font">{{ $earning->created_at->diffForHumans() }}</span></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif