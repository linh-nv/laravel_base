<form class="js-search-form form-inline-custom" action="{{route('clients.capitals.index')}}"
  id="f_search_capital" data-container="#js_list_capitals" novalidate data-action="search"
  data-module="capital">
  <div class="form-row text-left">
    <div class="form-group col-md-2">
      <label class="" for="search_key">{{ __('Từ khoá:') }}</label>
      <input type="text" class="form-control" name="search_key" placeholder="Nhập từ khoá">
      <div class="invalid-feedback" error-for="search_key">
        {{__('Vui lòng nhập :attribute',['attribute'=>'từ khoá'])}}
      </div>
    </div>
      <div class="form-group col-md-2">
          <label class="" for="shareholder_id">{{ __('Cổ đông') }}</label>
          <select name="shareholder_id" class="form-control js-select-search">
              <option value="">{{ __('Tất cả') }}</option>
              @foreach ($shareholders as $shareholder)
                  <option value="{{$shareholder->id}}">{{$shareholder->name}} ({{$shareholder->phone}})</option>
              @endforeach
          </select>
          <div class="invalid-feedback" error-for="shareholder_id">{{__('Vui lòng chọn :attribute',['attribute'=>'loại'])}}</div>
      </div>
      <div class="form-group col-md-2">
          <label class="" for="in_out">{{ __('Loại') }}</label>
          <select name="in_out" class="form-control js-select-search">
              <option value="">{{ __('Tất cả') }}</option>
              @foreach (config('type.capital') as $type)
                  <option value="{{$type['id']}}">{{$type['name']}}</option>
              @endforeach
          </select>
          <div class="invalid-feedback" error-for="in_out">{{__('Vui lòng chọn :attribute',['attribute'=>'loại'])}}</div>
      </div>
      <div class="form-group col-md-2">
          <label for="time_from" class="control-label">{{ __('Thời gian từ:') }}</label>
          <input type="text" class="form-control datetimepicker" name="time_from" value="">
          <div class="invalid-feedback" error-for="time_from">
              {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
      </div>
      <div class="form-group col-md-2">
          <label for="time_to" class="control-label">{{ __('đến:') }}</label>
          <input type="text" class="form-control datetimepicker" name="time_to" value="">
          <div class="invalid-feedback" error-for="time_to">
              {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
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
