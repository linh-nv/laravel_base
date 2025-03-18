<tr id={{ $category->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$category->code}}</td>
    <td>{{$category->name}}</td>
    <td>{{$category->recommend_amount}}</td>
    <td>{{$category->payment_day}} ngày</td>
    <td>{{$category->liquided_day}} ngày</td>
    <td>{{$category->description}}</td>
    <td>{!! $category->status_switch !!}</td>
    <td>{!! $category->action !!}</td>
</tr>
