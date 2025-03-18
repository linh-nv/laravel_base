<form class="js-search-form form-inline-custom" action="{{route('clients.categories.index')}}"
  id="f_search_category" data-container="#js_list_categories" novalidate data-action="search"
  data-module="category">
  <div class="form-row text-left">
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
        @foreach (config('status.category') as $status)
          <option value="{{$status['id']}}">{{$status['name']}}</option>
        @endforeach
      </select>
      <div class="invalid-feedback" error-for="status_id">{{__('Vui lòng chọn :attribute',['attribute'=>'trạng thái'])}}
      </div>
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
