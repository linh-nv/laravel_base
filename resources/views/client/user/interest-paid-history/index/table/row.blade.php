<tr id={{ $interestPaidHistory->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$interestPaidHistory->interest_pay_date_text}}</td>
    <td>{{$interestPaidHistory->payment_round}}</td>
    <td>{{$interestPaidHistory->interest_amount_text}}</td>
</tr>
