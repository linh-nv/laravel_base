<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Tên cổ đông') }}</th>
        <th>{{ __('Số điện thoại') }}</th>
        <th>{{ __('Số tiền') }}</th>
        <th>{{ __('Số tiền sau GD') }}</th>
        <th>{{ __('Loại') }}</th>
        <th>{{ __('Ngày') }}</th>
        <th>{{ __('Thông tin') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($capitalHistories as $capital)
        @include('client.user.capital.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $capitalHistories->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_capitals'])}}
