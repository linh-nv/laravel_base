<form action="{{route('clients.products.store')}}" method="POST" class="js-store-form"
      data-search-form="#f_search_product"
      novalidate data-action="store" data-module="product" data-list-url="{{route('clients.products.index')}}">
    <div class="modal-header">
        <h4 class="modal-title">{{__('Thêm sản phẩm')}}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('Tên sản phẩm') }}</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                    <div class="invalid-feedback" error-for="name">
                        {{__('Vui lòng nhập :attribute',['attribute'=>'tên sản phẩm'])}}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category_id" class="control-label">{{ __('Loại sản phẩm') }}</label>
                    <select name="category_id" class="form-control js-select-search js-change-autocomplete"
                            data-autocomplete-target="#js_recommend_amount">
                        <option>{{ __('Chọn loại sản phẩm') }}</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"
                                    data-autocomplete-value="{{$category->recommend_amount}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" error-for="category_id">
                        {{__('Vui lòng chọn :attribute',['attribute'=>'Loại sản phẩm'])}}
                    </div>
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
