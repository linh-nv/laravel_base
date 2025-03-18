@extends('client.layout.base',['pageTitle'=>'Loại hóa đơn'])
@section('content')
@include('client.layout.header')
<div class="wrapper">
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group pull-right">
                    </div>
                    <h4 class="page-title">{{__('Loại hóa đơn')}}</h4>
                    @can('add invoice types')
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-custom waves-effect waves-light" href="{{route('clients.invoice-types.create')}}">{{__('Thêm')}}</a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->



        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="table-rep-plugin">
                        <div class="table-wrapper">
                            @include('client.user.invoice_type.index.search-form')
                            <div class="table-responsive" data-pattern="priority-columns" id="js_list_invoice_types">
                                @include('client.user.invoice_type.index.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    <!--- end row -->

    </div> <!-- end container -->
</div>
<!-- end wrapper -->
@include('client.layout.footer')
@endsection
