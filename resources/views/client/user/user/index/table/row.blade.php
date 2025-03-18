<tr id={{ $user->row_id }}>
    <td  class="font-weight-bold">{{$loop->iteration}}</td>
    <td>{{$user->name}}</td>
    <td>{{$user->phone}}</td>
    <td>
        <span>
            {{$user->role_name}}
        </span>
        </td>
    <td>
        {!! $user->status_switch !!}
    </td>
    <td>{!! $user->action !!}</td>
</tr>
