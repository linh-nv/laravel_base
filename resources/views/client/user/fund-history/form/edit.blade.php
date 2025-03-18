<form novalidate data-action="store" data-module="fund_history" class="js-update-form"
      action="{{route('clients.fund-histories.update', ['fund_history' => $fundHistory->id])}}"
      data-list-url="{{route('clients.fund-histories.index')}}" method="PUT">
    <div class="modal-header">
        <h4 class="modal-title">{{__("Sửa thông tin lịch sử thanh toán")}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <input type="hidden" name="user_id" value="{{$userLogged->id}}">
            <div class="col-md-4">
{{--                <div class="form-group">--}}
{{--                    <label for="fundable_name" class="control-label">{{ __('Tên tài trợ') }}</label>--}}
{{--                    <input type="text" class="form-control" name="fundable_name" placeholder="Nhập tên tài trợ">--}}
{{--                    <div class="invalid-feedback" error-for="fundable_name">--}}
{{--                        {{__('Vui lòng nhập :attribute',['attribute'=>'tên tài trợ'])}}</div>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="fundable_type" class="control-label">{{ __('Loại tài trợ') }}</label>--}}
{{--                    <select id="js_pawn_fundable_type" name="fundable_type" class="form-control js-select-search">--}}
{{--                        <option>{{ __('Chọn loại tài trợ') }}</option>--}}
{{--                    </select>--}}
{{--                    <div class="invalid-feedback" error-for="fundable_type">--}}
{{--                        {{__('Vui lòng chọn :attribute',['attribute'=>'Loại tài trợ'])}}--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group">
                    <label for="invoice_type_id" class="control-label">{{ __('Loại thanh toán') }}</label>
                    <select id="js_pawn_invoice_type_id" name="invoice_type_id" class="form-control js-select-search">
                        <option>{{ __('Chọn loại thanh toán') }}</option>
                        @foreach ($invoiceTypes as $type)
                            <option value="{{$type['id']}}" {{$fundHistory->invoice_type_id==$type['id']?'selected':''}}>{{$type['name']}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" error-for="invoice_type_id">
                        {{__('Vui lòng chọn :attribute',['attribute'=>'Loại thanh toán'])}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="date" class="control-label">{{ __('Ngày thanh toán:') }}</label>
                    <input id="js_date" type="text" class="form-control datepicker" name="date"
                           value="{{$fundHistory->date_text}}">
                    <div class="invalid-feedback" error-for="date">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="amount" class="control-label">{{ __('Số tiền thanh toán') }}</label>
                    <div class="input-group">
                        <input id="js_pawn_amount" type="text" class="form-control js-vnd-input" value="{{$fundHistory->amount_text}}" data-unit="đồng" name="amount"
                               placeholder="Nhập số tiền thanh toán">
                        <div class="input-group-append">
                            <span class="input-group-text">vnđ</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="amount">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số tiền thanh toán'])}}</div>
                </div>
                <div class="form-group">
                    <label for="last_amount" class="control-label">{{ __('Số tiền còn lại') }}</label>
                    <div class="input-group">
                        <input id="js_pawn_last_amount" type="text" class="form-control js-vnd-input" value="{{$fundHistory->last_amount_text}}" data-unit="đồng" name="last_amount"
                               placeholder="Nhập số tiền còn lại">
                        <div class="input-group-append">
                            <span class="input-group-text">vnđ</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="last_amount">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số tiền còn lại'])}}</div>
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">{{ __('Ghi chú') }}</label>
                    <textarea class="form-control" name="description" value="{{$fundHistory->description}}"
                              placeholder=""></textarea>
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
