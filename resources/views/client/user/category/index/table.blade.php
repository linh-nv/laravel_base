<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Mã') }}</th>
        <th>{{ __('Tên') }}</th>
        <th>{{ __('Lãi suất') }}</th>
        <th>{{ __('Kỳ lãi') }}</th>
        <th>{{ __('Thanh lý') }}</th>
        <th>{{ __('Mô tả') }}</th>
        <th>{{ __('Trạng thái') }}</th>
        <th>{{ __('Hành động') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($categories as $category)
        @include('client.user.category.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $categories->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_categories'])}}
