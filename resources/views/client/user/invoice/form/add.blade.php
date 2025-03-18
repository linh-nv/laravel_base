<form action="{{route('clients.invoices.store')}}" method="POST" class="js-store-form" data-search-form="#f_search_invoice"
      novalidate data-action="store" data-module="invoice" data-list-url="{{route('clients.invoices.index')}}">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Thêm hóa đơn')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('Tên hóa đơn') }}</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên hóa đơn">
                    <div class="invalid-feedback" error-for="name">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'tên hóa đơn'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="invoice_type_id" class="control-label">{{ __('Loại hóa đơn') }}</label>
                    <select name="invoice_type_id" class="form-control js-select-search">
                        <option>{{ __('Chọn loại hóa đơn') }}</option>
                        @foreach ($invoiceTypes as $invoiceType)
                            <option value="{{$invoiceType->id}}">{{$invoiceType->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" error-for="invoice_type_id">
                        {{__('Vui lòng chọn :attribute',['attribute'=>'loại hóa đơn'])}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="user_id" class="control-label">{{ __('Người làm hóa đơn') }}</label>
                    <select name="user_id" class="form-control js-select-search">
                        <option value="{{$userLogged->id}}">{{ $userLogged->name }}</option>
                    </select>
                    <div class="invalid-feedback" error-for="user_id">
                        {{__('Vui lòng chọn :attribute',['attribute'=>'người làm hóa đơn'])}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="amount" class="control-label">{{ __('Số tiền') }}</label>
                    <input type="number" class="form-control" name="amount" placeholder="Nhập số tiền">
                    <div class="invalid-feedback" error-for="amount">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số tiền'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="date" class="control-label">{{ __('Ngày') }}</label>
                    <input type="text" class="form-control datepicker" name="date">
                    <div class="invalid-feedback" error-for="date">
                        {{__('Vui lòng chọn :attribute',['attribute'=>'ngày'])}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="control-label">{{ __('Nội dung') }}</label>
                    <textarea class="form-control" class="form-control" name="description" placeholder="Nhập nội dung"></textarea>
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
