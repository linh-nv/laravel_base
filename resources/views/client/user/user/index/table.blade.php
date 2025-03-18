<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Tên') }}</th>
        <th>{{ __('Số điện thoại') }}</th>
        <th>{{ __('Loại') }}</th>
        <th>{{ __('Trạng thái') }}</th>
        <th>{{ __('Hành động') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($users as $user)
        @include('client.user.user.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $users->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_users'])}}
