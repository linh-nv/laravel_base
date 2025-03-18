<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Tên') }}</th>
        <th>{{ __('Số điện thoại') }}</th>
        <th>{{ __('Email') }}</th>
        <th>{{ __('Vốn góp') }}</th>
        <th>{{ __('Hành động') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($shareholders as $shareholder)
        @include('client.user.shareholder.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $shareholders->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_shareholders'])}}
