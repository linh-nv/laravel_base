<tr id={{ $fundHistory->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$fundHistory->amount_text}}</td>
    <td>{{$fundHistory->last_amount_text}}</td>
    <td>{{$fundHistory->invoice_type_name}}</td>
    <td>{{$fundHistory->date_text}}</td>
    <td>{{$fundHistory->description}}</td>
</tr>
