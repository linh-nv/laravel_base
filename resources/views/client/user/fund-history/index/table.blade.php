<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Số tiền') }}</th>
        <th>{{ __('Số dư cuối') }}</th>
        <th>{{ __('Loại thanh toán') }}</th>
        <th>{{ __('Ngày') }}</th>
        <th>{{ __('Ghi chú') }}</th>

    </tr>
    </thead>
    <tbody>

    @foreach($fundHistories as $fundHistory)
        @include('client.user.fund-history.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $fundHistories->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_fund_histories'])}}
