<tr id={{ $product->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$product->name}}</td>
    <td>{{$product->category_name}}</td>
    <td>{!! $product->action !!}</td>
</tr>
