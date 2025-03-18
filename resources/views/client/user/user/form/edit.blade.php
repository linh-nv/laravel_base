<form novalidate data-action="store" data-module="user" class="js-update-form"
    action="{{route('clients.users.update', ['user' => $user->id])}}" data-list-url="{{route('clients.users.index')}}" method="PUT">
    <div class="modal-header">
        <h4 class="modal-title">{{__("Sửa thông tin người dùng")}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('Tên người dùng') }}</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Nhập tên người dùng">
                    <div class="invalid-feedback" error-for="name">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'tên người dùng'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone" class="control-label">{{ __('Số điện thoại') }}</label>
                    <input type="number" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Nhập số điện thoại">
                    <div class="invalid-feedback" error-for="phone">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số điện thoại'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email" class="control-label">{{ __('Email') }}</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="email">
                    <div class="invalid-feedback" error-for="email">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'email'])}}</div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="type" class="control-label">{{ __('Loại') }}</label>
                    <select name="role" class="form-control js-select-search">
                        <option>{{ __('Chọn loại') }}</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}" {{$user->role_name==$role->name?'selected':''}}>{{$role->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" error-for="role">
                        {{__('Vui lòng chọn :attribute',['attribute'=>'Loại người dùng'])}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status" class="control-label">{{ __('Trạng thái') }}</label>
                    <select name="status" class="form-control js-select-search">
                        <option>{{ __('Chọn trạng thái') }}</option>
                        @foreach (config('status.user') as $status)
                            <option value="{{$status['id']}}" {{$user->status_id==$status['id']?'selected':''}}>{{$status['name']}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" error-for="status_id">
                        {{__('Vui lòng chọn :attribute',['attribute'=>'trạng thái'])}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-spinner fa-spin hidden"></i>
            <i class="fa fa-save main-icon-btn"></i> Save
        </button>
    </div>
</form>
