<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Ngày') }}</th>
        <th>{{ __('Số tiền') }}</th>
        <th>{{ __('Số tiền còn lại') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pawnReceipt->loanPaidHistories as $loanPaidHistory)
        @include('client.user.loan-paid-history.index.table.row')
    @endforeach
    </tbody>
</table>
