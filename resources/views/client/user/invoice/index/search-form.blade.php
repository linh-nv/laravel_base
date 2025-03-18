<form class="js-search-form form-inline-custom" action="{{route('clients.invoices.index')}}"
  id="f_search_invoice" data-container="#js_list_invoices" novalidate data-action="search"
  data-module="invoice">
  <div class="form-row text-left">
    <div class="form-group col-md-2">
      <label class="" for="search_key">{{ __('Từ khoá:') }}</label>
      <input type="text" class="form-control" name="search_key" placeholder="Nhập từ khoá">
      <div class="invalid-feedback" error-for="search_key">
        {{__('Vui lòng nhập :attribute',['attribute'=>'từ khoá'])}}
      </div>
    </div>
    <div class="form-group col-md-2">
      <label class="" for="invoice_type_id">{{ __('Loại hóa đơn') }}</label>
      <select name="invoice_type_id" class="form-control js-select-search">
        <option value="">{{ __('Tất cả') }}</option>
        @foreach ($invoiceTypes as $invoiceType)
          <option value="{{$invoiceType->id}}">{{$invoiceType->name}}</option>
        @endforeach
      </select>
      <div class="invalid-feedback" error-for="invoice_type_id">{{__('Vui lòng chọn :attribute',['attribute'=>'loại'])}}</div>
    </div>
    <div class="form-group col-md-2">
      <label class="" for="user_id">{{ __('Người làm hóa đơn') }}</label>
      <select name="user_id" class="form-control js-select-search">
        <option value="">{{ __('Tất cả') }}</option>
        @foreach ($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
      </select>
      <div class="invalid-feedback" error-for="user_id">{{__('Vui lòng chọn :attribute',['attribute'=>'người làm hóa đơn'])}}</div>
    </div>
    <div class="form-group col-md-2">
      <label class="" for="status_id">{{ __('Trạng thái') }}</label>
      <select name="status_id" class="form-control js-select-search">
        <option value="">{{ __('Tất cả') }}</option>
        @foreach (config('status.invoice') as $status)
          <option value="{{$status['id']}}">{{$status['name']}}</option>
        @endforeach
      </select>
      <div class="invalid-feedback" error-for="status_id">{{__('Vui lòng chọn :attribute',['attribute'=>'trạng thái'])}}
      </div>
    </div>
    <div class="form-group col-md-2">
      <label for="time_from" class="control-label">{{ __('Thời gian từ:') }}</label>
      <input type="text" class="form-control datepicker" name="time_from" value="">
      <div class="invalid-feedback" error-for="time_from">
        {{__('Vui lòng nhập :attribute',['attribute'=>'thời gian'])}}</div>
    </div>
    <div class="form-group col-md-2">
      <label for="time_to" class="control-label">{{ __('đến:') }}</label>
      <input type="text" class="form-control datepicker" name="time_to" value="">
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
