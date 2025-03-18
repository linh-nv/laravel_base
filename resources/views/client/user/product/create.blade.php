@extends('client.layout.base',['pageTitle'=>'Sản phẩm'])
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
                    <h4 class="page-title">{{__('Sản phẩm')}}</h4>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->



        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="table-rep-plugin">
                        <div class="table-wrapper">
                            @include('client.user.product.form.add')
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
