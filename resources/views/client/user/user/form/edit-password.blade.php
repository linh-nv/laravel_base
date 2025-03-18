<form novalidate data-action="update_password" data-module="user" class="js-update-password-form"
      action="{{route('clients.users.update_password',['id'=>$user->id])}}" method="PATCH" data-redirect="{{route('clients.users.index')}}">
    <div class="modal-header">
        <h4 class="modal-title">{{__("Đổi mật khẩu cho tài khoản ")}}: {{$user->name}}({{$user->phone}}) <span class="js-username text-danger"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="new_password" class="control-label">{{ __('Mật khẩu mới:') }}</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Nhập mật khẩu mới">
                    <div class="invalid-feedback" error-for="new_password">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'mật khẩu'])}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="re_new_password" class="control-label">{{ __('Nhập lại mật khẩu mới:') }}</label>
                    <input type="password" class="form-control" name="re_new_password" placeholder="Nhập lại mật khẩu mới">
                    <div class="invalid-feedback" error-for="re_new_password">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'mật khẩu'])}}</div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-spinner fa-spin hidden"></i>
            <i class="fa fa-save main-icon-btn"></i> Thực hiện
        </button>
    </div>
</form>
