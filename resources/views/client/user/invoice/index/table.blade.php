<table class="table table-striped">
    <thead>
    <tr>
        <th>{{ __('Tên') }}</th>
        <th>{{ __('Loại hóa đơn') }}</th>
        <th>{{ __('Người làm hóa đơn') }}</th>
        <th>{{ __('Số tiền') }}</th>
        <th>{{ __('Ngày') }}</th>
        <th>{{ __('Mô tả') }}</th>
        <th>{{ __('Trạng thái') }}</th>
        <th>{{ __('Hành động') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($invoices as $invoice)
        @include('client.user.invoice.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $invoices->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_invoices'])}}
