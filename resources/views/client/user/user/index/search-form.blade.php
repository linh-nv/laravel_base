<form class="js-search-form form-inline-custom" action="{{route('clients.users.index')}}"
  id="f_search_user" data-container="#js_list_users" novalidate data-action="search"
  data-module="user">
  <div class="form-row text-left">
    <div class="form-group col-md-2">
      <label class="" for="search_key">{{ __('Từ khoá:') }}</label>
      <input type="text" class="form-control" name="search_key" placeholder="Nhập từ khoá">
      <div class="invalid-feedback" error-for="search_key">
        {{__('Vui lòng nhập :attribute',['attribute'=>'từ khoá'])}}
      </div>
    </div>
    <div class="form-group col-md-2">
      <label class="" for="type">{{ __('Loại') }}</label>
      <select name="role" class="form-control js-select-search">
        <option value="">{{ __('Tất cả') }}</option>
        @foreach ($roles as $role)
        <option value="{{$role->name}}">{{$role->name}}</option>
        @endforeach
      </select>
      <div class="invalid-feedback" error-for="role">{{__('Vui lòng chọn :attribute',['attribute'=>'loại'])}}</div>

    </div>
    <div class="form-group col-md-2">
      <label class="" for="status">{{ __('Trạng thái') }}</label>
      <select name="status" class="form-control js-select-search">
        <option value="">{{ __('Tất cả') }}</option>
        @foreach (config('status.user') as $status)
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
