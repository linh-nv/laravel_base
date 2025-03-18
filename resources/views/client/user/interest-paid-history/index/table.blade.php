<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Ngày') }}</th>
        <th>{{ __('Số kỳ lãi') }}</th>
        <th>{{ __('Số tiền') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($pawnReceipt->interestPaidHistories as $interestPaidHistory)
        @include('client.user.interest-paid-history.index.table.row')
    @endforeach
    </tbody>
</table>
