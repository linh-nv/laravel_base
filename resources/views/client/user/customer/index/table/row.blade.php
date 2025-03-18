<tr id={{ $customer->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$customer->name}}</td>
    <td>{{$customer->phone}}</td>
    <td>{{$customer->address}}</td>
    <td>{{$customer->identify_number}}</td>
    <td>{{$customer->tab_text}}</td>
    <td>{{$customer->tip_text}}</td>
    <td>{!! $customer->action !!}</td>
</tr>
