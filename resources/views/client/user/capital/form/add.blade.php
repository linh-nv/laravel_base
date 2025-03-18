<form action="{{route('clients.capitals.store')}}" method="POST" class="js-store-form" data-search-form="#f_search_capital"
    novalidate data-action="store" data-module="capital" data-list-url="{{route('clients.capitals.index')}}">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Cập nhật cổ phần')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-4">
                <label class="" for="shareholder_id">{{ __('Cổ đông') }}</label>
                <select name="shareholder_id" class="form-control js-select-search">
                    <option value="">{{ __('Chọn cổ đông') }}</option>
                @foreach ($shareholders as $shareholder)
                        <option value="{{$shareholder->id}}">{{$shareholder->name}} ({{$shareholder->phone}})</option>
                    @endforeach
                </select>
                <div class="invalid-feedback" error-for="shareholder_id">{{__('Vui lòng chọn :attribute',['attribute'=>'loại'])}}</div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="amount" class="control-label">{{ __('Số tiền') }}</label>
                    <input type="amount" class="form-control js-vnd-input" data-unit="đồng" name="amount" placeholder="Số tiền">
                    <div class="invalid-feedback" error-for="amount">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'số tiền'])}}</div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label-block" for="type">{{ __('Loại') }}</label>
                @foreach (config('type.capital') as $type)
                    <div class="radio radio-info form-check-inline">
                        <input type="radio" id="capital_in_{{$type['id']}}" value="{{$type['id']}}" name="is_in">
                        <label for="capital_in_{{$type['id']}}"> {{$type['name']}} </label>
                    </div>
                @endforeach
                <div class="invalid-feedback" error-for="is_in">{{__('Vui lòng chọn :attribute',['attribute'=>'loại'])}}</div>
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
