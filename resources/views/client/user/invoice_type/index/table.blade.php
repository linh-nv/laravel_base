<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Tên') }}</th>
        <th>{{ __('Hành động') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($invoiceTypes as $invoiceType)
        @include('client.user.invoice_type.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $invoiceTypes->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_invoice_types'])}}
