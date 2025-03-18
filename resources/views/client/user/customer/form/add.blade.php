<form action="{{route('clients.customers.store')}}" method="POST" class="js-store-form" data-search-form="#f_search_customer"
      novalidate data-action="store" data-module="customer" data-list-url="{{route('clients.customers.index')}}">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Thêm khách hàng')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('Tên khách hàng') }}</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên khách hàng">
                    <div class="invalid-feedback" error-for="name">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'tên khách hàng'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone" class="control-label">{{ __('Số điện thoại') }}</label>
                    <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại">
                    <div class="invalid-feedback" error-for="phone">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số điện thoại'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="address" class="control-label">{{ __('Địa chỉ') }}</label>
                    <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ">
                    <div class="invalid-feedback" error-for="address">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'địa chỉ'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="identify_number" class="control-label">{{ __('Số CMND/CCCD') }}</label>
                    <input type="number" class="form-control" name="identify_number" placeholder="Nhập số CMND/CCCD">
                    <div class="invalid-feedback" error-for="identify_number">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số CMND/CCCD'])}}</div>
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
