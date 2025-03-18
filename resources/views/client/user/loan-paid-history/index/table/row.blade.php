<tr id={{ $loanPaidHistory->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$loanPaidHistory->loan_payment_date_text}}</td>
    <td>{{$loanPaidHistory->loan_text}}</td>
    <td>{{$loanPaidHistory->last_loan_text}}</td>
</tr>
