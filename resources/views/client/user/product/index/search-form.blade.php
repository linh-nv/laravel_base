<form class="js-search-form form-inline-custom" action="{{route('clients.products.index')}}"
  id="f_search_product" data-container="#js_list_products" novalidate data-action="search"
  data-module="product">
  <div class="form-row text-left">
    <div class="form-group col-md-2">
      <label class="" for="search_key">{{ __('Từ khoá:') }}</label>
      <input type="text" class="form-control" name="search_key" placeholder="Nhập từ khoá">
      <div class="invalid-feedback" error-for="search_key">
        {{__('Vui lòng nhập :attribute',['attribute'=>'từ khoá'])}}
      </div>
    </div>
    <div class="form-group col-md-2">
      <label class="" for="category_id">{{ __('Loại sản phẩm') }}</label>
      <select name="category_id" class="form-control js-select-search">
        <option value="">{{ __('Tất cả') }}</option>
        @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
      <div class="invalid-feedback" error-for="category_id">{{__('Vui lòng chọn :attribute',['attribute'=>'loại'])}}</div>
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
