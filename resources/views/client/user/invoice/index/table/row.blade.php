<tr id={{ $invoice->row_id }}>
    <td>{{$invoice->name}}</td>
    <td>{{$invoice->invoice_type_name}}</td>
    <td>{{$invoice->user_name}}</td>
    <td>{{$invoice->amount_text}}</td>
    <td>{{$invoice->date_text}}</td>
    <td>{{$invoice->description}}</td>
    <td>{!! $invoice->status_name !!}</td>
    <td>{!! $invoice->action !!}</td>
</tr>
