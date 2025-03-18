<form action="{{route('clients.pawn-receipts.store')}}" method="POST" class="js-store-form"
      novalidate data-action="store" data-module="pawn_receipt">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Phiếu cầm đồ')}}</h4>
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
                <div class="form-group">
                    <label for="phone" class="control-label">{{ __('Số điện thoại') }}</label>
                    <input type="number" class="form-control" name="phone" placeholder="Nhập số điện thoại">
                    <div class="invalid-feedback" error-for="phone">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số điện thoại'])}}</div>
                </div>
                <label class="control-label collapsed" type="button" data-toggle="collapse"
                       data-target="#more_customer_info" aria-expanded="false"
                       aria-controls="more_customer_info">
                    <i class="fa fa-plus"></i> Thông tin thêm
                </label>
                <div class="collapse" id="more_customer_info">
                    <div class="form-group">
                        <label for="address" class="control-label">{{ __('Địa chỉ') }}</label>
                        <input type="address" class="form-control" name="address" placeholder="Địa chỉ">
                        <div class="invalid-feedback" error-for="address">
                            {{__('Vui lòng nhập :attribute',['attribute'=>'address'])}}</div>
                    </div>
                    <div class="form-group">
                        <label for="identify_number" class="control-label">{{ __('Số CMT') }}</label>
                        <input type="number" class="form-control" name="identify_number" placeholder="Nhập CMT">
                        <div class="invalid-feedback" error-for="identify_number">
                            {{__('Vui lòng nhập :attribute',['attribute'=>'số CMT'])}}</div>
                    </div>
                    <div class="form-group">
                        <label for="identify_date" class="control-label">{{ __('Ngày cấp') }}</label>
                        <input type="text" class="form-control" name="identify_date" placeholder="Ngày cấp"
                               data-mask="99/99/9999">
                        <div class="invalid-feedback" error-for="identify_date">
                            {{__('Vui lòng nhập :attribute',['attribute'=>'ngày cấp'])}}</div>
                    </div>
                    <div class="form-group">
                        <label for="identify_region" class="control-label">{{ __('Nơi cấp') }}</label>
                        <input type="text" class="form-control" name="identify_region" placeholder="Nơi cấp">
                        <div class="invalid-feedback" error-for="identify_region">
                            {{__('Vui lòng nhập :attribute',['attribute'=>'nơi cấp'])}}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category_id" class="control-label">{{ __('Loại hàng hoá') }}</label>
                    <select id="js_pawn_category_id" name="category_id" class="form-control js-select-search">
                        <option>{{ __('Chọn nhóm hàng hoá') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" data-interest-percent="{{$category->recommend_amount}}"
                                    data-payment-day="{{$category->payment_day}}"
                                    data-liquidated-day="{{$category->liquided_day}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" error-for="category_id">
                        {{__('Vui lòng chọn :attribute',['attribute'=>'Loại hàng hoá'])}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_name" class="control-label">{{ __('Tên hàng hoá') }}</label>
                    <input type="text" class="form-control" name="product_name" placeholder="Tên hàng hoá">
                    <div class="invalid-feedback" error-for="product_name">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'Tên hàng hoá'])}}</div>
                </div>
                <div class="form-group">
                    <label for="product_description" class="control-label">{{ __('Đặc điểm hàng hoá') }}</label>
                    <textarea class="form-control" name="product_description"
                              placeholder="Ví dụ: màu sắc, mã hàng hoá, vvv"></textarea>
                    <div class="invalid-feedback" error-for="product_description">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'nội dung'])}}</div>
                </div>
                <label for="attached_product_name" class="control-label">{{ __('Hàng hoá đi kèm') }}</label>
                <button class="btn btn-primary js-before-append" type="button" data-before-append="
                            <hr class='js-dividing-line'/>
<div class='row js-attached-product-element js-parent-remove'>
    <div class='form-group col-md-6'>
        <label for='attached_product_name' class='control-label'>
            {{ __('Tên') }}
                    </label>
                    <input type='text' class='form-control' name='attached_product_name' placeholder='Tên'/>
                    <div class='invalid-feedback' error-module='attached_products' error-field='name'>
{{ __('Vui lòng nhập :attribute',['attribute'=>'tên hàng hoá']) }}
                    </div>
                </div>
                <div class='form-group col-md-6'>
                    <label for='attached_product_description' class='control-label'>
{{ __('Mô tả') }}
                    </label>
                    <input type='text' class='form-control' name='attached_product_description' placeholder='Mô tả'/>
                    <div class='invalid-feedback' error-module='attached_products' error-field='description'>
{{ __('Vui lòng nhập :attribute',['attribute'=>'mô tả hàng hoá']) }}
                    </div>
                    <button type='button' class='js-remove-parent text-left'>
                    <span aria-hidden='true'>
                        ×
                    </span>
                </button>
                </div>


            </div>
">+
                </button>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="origin_amount" class="control-label">{{ __('Số tiền') }}</label>
                    <div class="input-group">
                        <input id="js_pawn_origin_amount" type="text" class="form-control js-vnd-input" data-unit="đồng" name="origin_amount"
                               placeholder="Nhập số tiền cho vay">
                        <div class="input-group-append">
                            <span class="input-group-text">vnđ</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="origin_amount">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số tiền'])}}</div>
                </div>
                <div class="form-group">
                    <label for="interest_percent" class="control-label">{{ __('Lãi suất') }} (%)</label>
                    <div class="input-group">
                        <input id="js_pawn_interest_percent" type="number" class="form-control" name="interest_percent"
                               placeholder="Nhập lãi suất">
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="interest_percent">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'lãi suất'])}}</div>
                </div>

                <div class="form-group">
                    <label for="interest_amount" class="control-label">{{ __('Lãi suất') }} (vnđ)</label>
                    <div class="input-group">
                        <input id="js_pawn_interest_amount" type="text" class="form-control js-vnd-input" data-unit="đồng" name="interest_amount"
                               placeholder="Nhập lãi suất">
                        <div class="input-group-append">
                            <span class="input-group-text">vnđ</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="interest_amount">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'lãi suất'])}}</div>
                </div>
                <div class="form-group">
                    <label for="pawn_date" class="control-label">{{ __('Ngày vay:') }}</label>
                    <input id="js_pawn_date" type="text" class="form-control datepicker" name="pawn_date"
                           value="{{date('d/m/Y')}}">
                    <div class="invalid-feedback" error-for="pawn_date">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
                </div>
                <div class="form-group">
                    <label for="payment_day" class="control-label">{{ __('Hạn trả lãi:') }}</label>
                    <div class="input-group">
                        <input id="js_pawn_payment_day" type="text" class="form-control" name="payment_day" value="">
                        <div class="input-group-append">
                            <span class="input-group-text">ngày</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="payment_day">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
                </div>
                <div class="form-group">
                    <label for="liquidated_day" class="control-label">{{ __('Hạn thanh lý:') }}</label>
                    <div class="input-group">
                        <input id="js_pawn_liquidated_day" type="text" class="form-control" name="liquidated_day"
                               value="">
                        <div class="input-group-append">
                            <span class="input-group-text">ngày</span>
                        </div>
                    </div>
                    <div class="invalid-feedback" error-for="liquidated_day">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
                </div>
                <div class="form-group">
                    <label for="note" class="control-label">{{ __('Ghi chú') }}</label>
                    <textarea class="form-control" name="note"
                              placeholder=""></textarea>
                    <div class="invalid-feedback" error-for="note">
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
