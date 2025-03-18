<form action="{{route('clients.fund-histories.store')}}" method="POST" class="js-store-form"
      novalidate data-action="store" data-module="fund_history"
      data-list-url="{{route('clients.fund-histories.index')}}">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Thêm hoá đơn')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="form-group  col-md-4">
                <label for="invoice_type_id" class="control-label">{{ __('Loại hoá đơn') }}</label>
                <select id="js_pawn_invoice_type_id" name="invoice_type_id" class="form-control js-select-search">
                    <option>{{ __('Chọn loại hoá đơn') }}</option>
                    @foreach ($invoiceTypes as $type)
                        @if(!$type->is_system)
                            <option value="{{$type->id}}">{{$type->name}}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback" error-for="invoice_type_id">
                    {{__('Vui lòng chọn :attribute',['attribute'=>'Loại hoá đơn'])}}
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="amount" class="control-label">{{ __('Số tiền hoá đơn') }}</label>
                <div class="input-group">
                    <input id="js_pawn_amount" type="text" class="form-control js-vnd-input" data-unit="đồng"
                           name="amount"
                           placeholder="Nhập số tiền hoá đơn">
                    <div class="input-group-append">
                        <span class="input-group-text">vnđ</span>
                    </div>
                </div>
                <div class="invalid-feedback" error-for="amount">
                    {{__('Vui lòng nhập :attribute',['attribute'=>'số tiền'])}}</div>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label-block" for="type">{{ __('Loại') }}</label>
                    <div class="radio radio-info form-check-inline">
                        <input type="radio" id="fund_in" value="1" name="is_in">
                        <label for="fund_in"> Nhập </label>
                    </div>
                <div class="radio radio-info form-check-inline">
                    <input type="radio" id="fund_out" value="0" name="is_in">
                    <label for="fund_out"> Xuất </label>
                </div>
                <div class="invalid-feedback"
                     error-for="is_in">{{__('Vui lòng chọn :attribute',['attribute'=>'loại'])}}</div>
            </div>
            <div class="form-group col-md-4">
                <label for="date" class="control-label">{{ __('Ngày hoá đơn:') }}</label>
                <input id="js_date" type="text" class="form-control datepicker" name="date"
                       value="{{date('d/m/Y')}}">
                <div class="invalid-feedback" error-for="date">
                    {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
            </div>
            <div class="form-group col-md-8">
                <label for="description" class="control-label">{{ __('Ghi chú') }}</label>
                <textarea class="form-control" name="description"
                          placeholder=""></textarea>
                <div class="invalid-feedback" error-for="description">
                    {{__('Vui lòng nhập :attribute',['attribute'=>'nội dung'])}}</div>
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
