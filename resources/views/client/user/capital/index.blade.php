@extends('client.layout.base',['pageTitle'=>'Cổ phần'])
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
                    <h4 class="page-title">{{__('Cổ phần')}}</h4>
                    @can('add capitals')
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-custom waves-effect waves-light" href="{{route('clients.capitals.create')}}">{{__('Thêm')}}</a>
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
                            @include('client.user.capital.index.search-form')
                            <div class="table-responsive" data-pattern="priority-columns" id="js_list_capitals">
                                @include('client.user.capital.index.table')
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
