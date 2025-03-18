<form novalidate data-action="store" data-module="invoice_type" class="js-update-form"
    action="{{route('clients.invoice-types.update', ['invoice_type' => $invoiceType->id])}}"
    data-row-id="#{{$invoiceType->row_id}}" method="PUT" data-list-url="{{route('clients.invoice-types.index')}}">
    <div class="modal-header">
        <h4 class="modal-title">{{__("Sửa thông tin loại hóa đơn")}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('Tên loại hóa đơn') }}</label>
                    <input type="text" class="form-control" name="name" value="{{ $invoiceType->name }}" placeholder="Nhập tên loại hóa đơn">
                    <div class="invalid-feedback" error-for="name">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'tên loại hóa đơn'])}}</div>
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
