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
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->



        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="table-rep-plugin">
                        <div class="table-wrapper">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-justify font-weight-bold">{{__("UID:")}}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-justify">{{$userLogged->id}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-justify font-weight-bold">{{__("Tên người dùng:")}}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-justify">{{$userLogged->name}}</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="text-justify font-weight-bold">{{__("Quyền:")}}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-justify">{{$userLogged->role_name}}</h5>
                                    </div>
                                </div>
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
