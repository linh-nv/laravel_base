<form class="js-search-form form-inline-custom" action="{{route('clients.pawn-receipts.index')}}"
      id="f_search_pawn_receipt" data-container="#js_list_pawn_receipts" novalidate data-action="search"
      data-module="pawn_receipt">
    <div class="form-row text-left">
        <div class="form-group col-md-12">
            <div class="form-group text-left">
                <label>
                    {{__('Chọn tháng:')}}
                </label>
                <div class="list-month">
                    @for ($i = 1; $i < 13; $i++)
                        <div class="col-md-1 col-sm-4 col-6 month-item an">
                            <div class="month-item-text {{$i==date('m')?'active':''}}" data-month="{{$i}}">
                                <p>Tháng {{$i}}</p>
                            </div>
                        </div>

                    @endfor
                    <div class="clearfix">
                    </div>
                </div>
                <input type="number" name="month" class="input-hidden" value="{{date('m')}}">
                <div class="invalid-feedback" error-for="search_key">
                    {{__('Vui lòng nhập :attribute',['attribute'=>'từ khoá'])}}
                </div>
            </div>
        </div>
        <div class="form-group col-md-2">
            <label class="" for="search_key">{{ __('Từ khoá:') }}</label>
            <input type="text" class="form-control" name="search_key" placeholder="Nhập từ khoá">
            <div class="invalid-feedback" error-for="search_key">
                {{__('Vui lòng nhập :attribute',['attribute'=>'từ khoá'])}}
            </div>
        </div>
        <div class="form-group col-md-2">
            <label class="" for="status_id">{{ __('Trạng thái') }}</label>
            <select name="status_id" class="form-control js-select-search">
                <option value="">{{ __('Tất cả') }}</option>
                @foreach (config('status.pawn_receipt') as $status)
                    <option value="{{$status['id']}}">{{$status['name']}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback"
                 error-for="status_id">{{__('Vui lòng chọn :attribute',['attribute'=>'trạng thái'])}}</div>
        </div>
        <div class="form-group col-md-2">
            <label class="inline-btn-lable" for="submit"></label>
            <button type="submit" class="btn btn-primary search-button form-control">
                <i class="fa fa-spinner fa-spin hidden"></i>
                <i class="fa fa-filter main-icon-btn"></i>
                {{ __('Filter') }}
            </button>
        </div>
    </div>


</form>
