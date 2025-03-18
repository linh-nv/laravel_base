<tr id={{ $invoiceType->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$invoiceType->name}}</td>
    <td>{!! $invoiceType->action !!}</td>
</tr>
