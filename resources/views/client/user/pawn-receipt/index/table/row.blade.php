<tr id={{ $pawnReceipt->row_id }} class={{$pawnReceipt->bg_class ?? ''}}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$pawnReceipt->name}}</td>
    <td>{{$pawnReceipt->phone}}</td>
    <td>{{$pawnReceipt->origin_amount_text}}</td>
    <td>{{$pawnReceipt->loan_paid_text}}</td>
    <td>{{$pawnReceipt->interest_amount_text}}({{$pawnReceipt->interest_percent}}%)</td>
    <td>{{$pawnReceipt->interest_paid_text}}</td>
    <td>{{$pawnReceipt->payment_day}}</td>
    <td>{{$pawnReceipt->deadline}}</td>
    <td>{{$pawnReceipt->liquidated_date}}</td>
    <td>{{$pawnReceipt->status_text}}</td>
    <td>{!! $pawnReceipt->action !!}</td>
</tr>
