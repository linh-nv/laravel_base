<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Tên khách hàng') }}</th>
        <th>{{ __('Số điện thoại') }}</th>
        <th>{{ __('Tiền vay') }}</th>
        <th>{{ __('Đã trả') }}</th>
        <th>{{ __('Lãi') }}</th>
        <th>{{ __('Lãi đã trả') }}</th>
        <th>{{ __('Kỳ lãi') }} ({{__('ngày')}})</th>
        <th>{{ __('Hạn trả lãi') }}</th>
        <th>{{ __('Hạn thanh lý') }}</th>
        <th>{{ __('Trạng thái') }}</th>
        <th>{{ __('Hành động') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($pawnReceipts as $pawnReceipt)
        @include('client.user.pawn-receipt.index.table.row')
    @endforeach

    </tbody>
</table>
{{--{{ $pawnReceipts->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_pawn_receipts'])}}--}}
