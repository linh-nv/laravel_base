@extends('client.layout.base',['pageTitle'=>'Người dùng'])
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
                    <h4 class="page-title">{{__('Người dùng')}}</h4>
                    @can('add users')
                    <div class="btn-group pull-right">
                        <a type="button" class="btn btn-custom waves-effect waves-light" href="{{route('clients.users.create')}}">{{__('Thêm')}}</a>
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
                            @include('client.user.user.index.search-form')
                            <div class="table-responsive" data-pattern="priority-columns" id="js_list_users">
                                @include('client.user.user.index.table')
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- end container -->
</div>
<!-- end wrapper -->
@include('client.layout.footer')
@endsection
