<div class="modal-header">
    <h4 class="modal-title">{{__('Chi tiết phiếu cầm đồ:')}} {{$pawnReceipt->code}}</h4>
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
                <tr>
                    <th>{{__('Địa chỉ')}}</th>
                    <td>{{$pawnReceipt->address}}</td>
                </tr>
                <tr>
                    <th>{{__('Số CMND')}}</th>
                    <td>{{$pawnReceipt->identify_number}}</td>
                </tr>
                <tr>
                    <th>{{__('Ngày cấp')}}</th>
                    <td>{{$pawnReceipt->identify_date}}</td>
                </tr>
                <tr>
                    <th>{{__('Nơi cấp')}}</th>
                    <td>{{$pawnReceipt->identify_region}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table detail-form">
                <thead>
                <h5>{{__("Thông tin hàng hoá")}}</h5>
                </thead>
                <tbody>
                <tr>
                    <th>{{__('Loại hàng hoá')}}</th>
                    <td>{{$pawnReceipt->category_name}}</td>
                </tr>
                <tr>
                    <th>{{__('Tên hàng hoá')}}</th>
                    <td>{{$pawnReceipt->product_name}}</td>
                </tr>
                <tr>
                    <th>{{__('Thông tin hàng hoá')}}</th>
                    <td>{{$pawnReceipt->product_info}}</td>
                </tr>
                <tr>
                    <th colspan="2">{{__('Hàng hoá đi kèm')}}</th>
                </tr>
                @if(count($pawnReceipt->attached_products)>0)
                    <tr>
                        <td  colspan="2">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>{{__('Tên')}}</td>
                                    <td>{{__('Mô tả')}}</td>
                                </tr>

                                </tr>
                                @foreach($pawnReceipt->attached_products as $attachedProduct)
                                    <tr>
                                        <th>{{$attachedProduct->name}}</th>
                                        <td>{{$attachedProduct->description}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </td>
                    </tr>
                @endif
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
                <tr>
                    <th>{{__('Kỳ lãi')}}</th>
                    <td>{{$pawnReceipt->payment_day}} ngày</td>
                </tr>
                <tr>
                    <th>{{__('Thanh lý sau')}}</th>
                    <td>{{$pawnReceipt->liquidated_day}} ngày</td>
                </tr>

                <tr>
                    <th>{{__('Ghi chú')}}</th>
                    <td>{{$pawnReceipt->note}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">@include('client.user.interest-paid-history.sub-list',['pawnReceiptId',$pawnReceipt->id])</div>
    <div class="col-md-6">@include('client.user.loan-paid-history.sub-list',['pawnReceiptId',$pawnReceipt->id])</div>
</div>


<div class="modal-footer">
    <a href="{{route('clients.pawn-receipts.index')}}" class="btn btn-secondary waves-effect" data-dismiss="modal">Về trang chủ</a>
    <a href="{{route('clients.pawn-receipts.pay-interest',['pawn_receipt'=>$pawnReceipt->id])}}" class="btn btn-danger waves-effect waves-light"><i class="fa fa-spinner fa-spin hidden"></i>
        <i class="fa fa-money main-icon-btn"></i> Đóng lãi
    </a>
    <a href="{{route('clients.pawn-receipts.pay-loan',['pawn_receipt'=>$pawnReceipt->id])}}" class="btn btn-success waves-effect waves-light"><i class="fa fa-spinner fa-spin hidden"></i>
        <i class="fa fa-stop-circle main-icon-btn"></i> Trả gốc
    </a>
</div>
