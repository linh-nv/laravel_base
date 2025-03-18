<form action="{{route('clients.shareholders.store')}}" method="POST" class="js-store-form" data-list-url="{{route('clients.shareholders.index')}}"
    novalidate data-action="store" data-module="shareholder">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Thêm cổ đông')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('Tên cổ đông') }}</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên cổ đông">
                    <div class="invalid-feedback" error-for="name">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'tên cổ đông'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone" class="control-label">{{ __('Số điện thoại') }}</label>
                    <input type="number" class="form-control" name="phone" placeholder="Nhập số điện thoại">
                    <div class="invalid-feedback" error-for="phone">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số điện thoại'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email" class="control-label">{{ __('Email') }}</label>
                    <input type="email" class="form-control" name="email" placeholder="email">
                    <div class="invalid-feedback" error-for="email">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'email'])}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="password" class="control-label">{{ __('Mật khẩu') }}</label>
                    <input type="text" class="form-control" name="password" placeholder="Nhập mật khẩu">
                    <div class="invalid-feedback" error-for="password">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'mật khẩu'])}}</div>
                </div>
            </div>
        </div>
        <div class="row">


        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-spinner fa-spin hidden"></i>
            <i class="fa fa-save main-icon-btn"></i> Save
        </button>
    </div>
</form>
