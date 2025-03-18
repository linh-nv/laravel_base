<form action="{{route('clients.pawn-receipts.pay-loan-handle',['pawn_receipt'=>$pawnReceipt->id])}}" method="POST" class="js-store-form"
      novalidate data-action="pay_loan" data-module="pawn_receipt" data-list-url="{{route('clients.pawn-receipts.show',['pawn_receipt'=>$pawnReceipt->id])}}">
<div class="modal-header">
    <h4 class="modal-title">{{__('Trả gốc phiếu cầm đồ:')}} {{$pawnReceipt->code}}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <table class="table detail-form">
                <thead>
                <h5>{{__("Thông tin khách hàng")}}</h5>
                </thead>
                <tbody>
                <tr>
                    <th>{{__('Tên khách hàng')}}</th>
                    <td>{{$pawnReceipt->name}}</td>
                </tr>
                <tr>
                    <th>{{__('Số điện thoại')}}</th>
                    <td>{{$pawnReceipt->phone}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table detail-form">
                <thead>
                <h5>{{__("Thông tin khoản vay")}}</h5>
                </thead>
                <tbody>
                <tr>
                    <th>{{__('Ngày cho vay')}}</th>
                    <td>{{$pawnReceipt->pawn_date_text}}</td>
                </tr>
                <tr>
                    <th>{{__('Số tiền cho vay')}}</th>
                    <td>{{$pawnReceipt->origin_amount_text}} vnđ</td>
                </tr>
                <tr>
                    <th>{{__('Còn nợ')}}</th>
                    <td>{{$pawnReceipt->remain_loan_text}} vnđ</td>
                </tr>
                <tr>
                    <th>{{__('Lãi suất')}}</th>
                    <td>{{$pawnReceipt->interest_amount_text}} vnđ ({{$pawnReceipt->interest_percent}}%)</td>
                </tr>
                <tr>
                    <th>{{__('Tiền lãi đã trả')}}</th>
                    <td>{{$pawnReceipt->interest_paid_text}} vnđ</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">

            <div class="form-group">
                <label for="loan" class="control-label">{{ __('Số tiền') }}</label>
                <div class="input-group">
                    <input id="js_loan" type="text" class="form-control js-vnd-input" data-unit="đồng" name="loan"
                           placeholder="Nhập số tiền" value="{{$pawnReceipt->remain_loan_text}}">
                    <div class="input-group-append">
                        <span class="input-group-text">vnđ</span>
                    </div>
                </div>
                <div class="invalid-feedback" error-for="loan">
                    {{__('Vui lòng nhập :attribute',['attribute'=>'số tiền'])}}</div>
            </div>
            <div class="form-group">
                <label for="loan_payment_date" class="control-label">{{ __('Ngày trả gốc:') }}</label>
                <input id="js_loan_payment_date" type="text" class="form-control datepicker" name="loan_payment_date"
                       value="{{date('d/m/Y')}}">
                <div class="invalid-feedback" error-for="loan_payment_date">
                    {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <a href="{{route('clients.pawn-receipts.index')}}" class="btn btn-secondary waves-effect" data-dismiss="modal">Về trang chủ</a>
    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-spinner fa-spin hidden"></i>
        <i class="fa fa-save main-icon-btn"></i> Save
    </button>
</div>
</form>
