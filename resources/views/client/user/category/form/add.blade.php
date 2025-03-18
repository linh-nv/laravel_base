<form action="{{route('clients.categories.store')}}" method="POST" class="js-store-form"
      data-search-form="#f_search_category"
      novalidate data-action="store" data-module="category" data-list-url="{{route('clients.categories.index')}}">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Thêm nhóm hàng hóa')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('Tên nhóm hàng hóa') }}</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên nhóm hàng hóa">
                    <div class="invalid-feedback" error-for="name">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'tên nhóm hàng hóa'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="code"
                           class="control-label">{{ __('Mã nhóm hàng hóa (Viết hoa liền , ex: XEMAY)') }}</label>
                    <input type="text" class="form-control" name="code" placeholder="Nhập mã nhóm hàng hóa">
                    <div class="invalid-feedback" error-for="code">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'mã nhóm hàng hóa'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="recommend_amount" class="control-label">{{ __('Lãi suất') }}</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="recommend_amount" placeholder="Nhập lãi suất">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="recommend_amount">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'lãi suất'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="payment_day" class="control-label">{{ __('Kỳ lãi') }}</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="payment_day" placeholder="Kỳ lãi">
                        <div class="input-group-append">
                            <span class="input-group-text">ngày</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="payment_day">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'kỳ lãi'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="liquided_day" class="control-label">{{ __('Thanh lý') }}</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="liquided_day" placeholder="Thanh lý">
                        <div class="input-group-append">
                            <span class="input-group-text">ngày</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="liquided_day">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số ngày thanh lý'])}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="control-label">{{ __('Nội dung') }}</label>
                    <textarea class="form-control" class="form-control" name="description"
                              placeholder="Nhập nội dung"></textarea>
                    <div class="invalid-feedback" error-for="description">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'nội dung'])}}</div>
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
