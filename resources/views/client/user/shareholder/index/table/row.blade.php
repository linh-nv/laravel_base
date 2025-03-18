<tr id={{ $shareholder->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$shareholder->name}}</td>
    <td>{{$shareholder->phone}}</td>
    <td>{{$shareholder->email}}</td>
    <td>{{$shareholder->total_capital_text}}</td>
    <td>{!! $shareholder->action !!}</td>
</tr>
