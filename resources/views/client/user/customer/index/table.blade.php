<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Tên') }}</th>
        <th>{{ __('Số điện thoại') }}</th>
        <th>{{ __('Địa chỉ') }}</th>
        <th>{{ __('Số CMND/CCCD') }}</th>
        <th>{{ __('Đã vay') }}(VNĐ)</th>
        <th>{{ __('Đã trả') }}(VNĐ)</th>
        <th>{{ __('Hành động') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($customers as $customer)
        @include('client.user.customer.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $customers->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_customers'])}}
