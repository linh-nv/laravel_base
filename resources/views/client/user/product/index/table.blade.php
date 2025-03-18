<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>{{ __('Tên') }}</th>
        <th>{{ __('Loại sản phẩm') }}</th>
        <th>{{ __('Hành động') }}</th>
    </tr>
    </thead>
    <tbody>

    @foreach($products as $product)
        @include('client.user.product.index.table.row')
    @endforeach

    </tbody>
</table>
{{ $products->onEachSide(2)->links('client.share.paginator',['resultTable'=>'#js_list_products'])}}
