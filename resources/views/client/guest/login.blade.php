@extends('client.layout.base',['pageTitle'=>'Login','bodyClass'=>'bg-accpunt-pages'])
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account-box">
                                <div class="account-logo-box">
                                    <h2 class="text-uppercase text-center">
                                        <a href="index.html" class="text-success">
                                            <span><img src="{{asset('client/assets/images/full-logo.png')}}"
                                                       alt=""></span>
                                        </a>
                                    </h2>
                                    <h5 class="text-uppercase font-bold m-b-5 m-t-50">{{__('Đăng nhập')}}</h5>
                                    <p class="m-b-0">{{__('Đăng nhập vào tài khoản của bạn.')}}</p>
                                </div>
                                <div class="account-content">
                                    <form id="js_login_form" class="form-horizontal needs-validation js-auth-form"
                                          action="{{route('clients.sign_in')}}" method="POST" novalidate validate="yes" data-action="login" data-module="auth">

                                        <div class="form-group m-b-20 row">
                                            <div class="col-12">
                                                <label for="username">{{__('Tên đăng nhập')}}</label>
                                                <input class="form-control" type="username" name="username" required
                                                       placeholder="{{__('Nhập vào đăng nhập.')}}">
                                                <div class="invalid-feedback"
                                                     error-for="username">{{__('Tên đăng nhập không hợp lệ')}}</div>
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <a href="{{route('clients.forgot_password')}}"
                                                   class="text-muted pull-right"><small>{{__('Quên mật khẩu?')}}</small></a>
                                                <label for="password">{{__('Mật khẩu')}}</label>
                                                <input class="form-control" type="password" required name="password"
                                                       placeholder="{{__('Nhập vào mật khẩu.')}}">
                                                <div class="invalid-feedback"
                                                     error-for="password">{{__('Vui lòng nhập mật khẩu')}}</div>
                                            </div>
                                        </div>


                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <div id="g_recaptcha"></div>
                                                <div class="invalid-feedback"
                                                     error-for="g_recaptcha">{{__('Vui lòng xác nhận bạn không phải là máy')}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <div class="checkbox checkbox-success">
                                                    <input id="remember" type="checkbox" checked="">
                                                    <label for="remember">
                                                        {{__('Ghi nhớ tôi')}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <button
                                                    class="btn btn-md btn-block btn-primary waves-effect waves-light" type='submit'>{{__('Đăng nhập')}}
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                    <div class="row m-t-50">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted">{{__('Bạn chưa có tài khoản?')}} <a
                                                    href="{{route('clients.sign_up')}}"
                                                    class="text-dark m-l-5"><b>{{__('Đăng ký ngay')}}</b></a></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end card-box-->


                    </div>
                    <!-- end wrapper -->

                </div>
            </div>
        </div>
    </section>
@endsection
@section('head-script')
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        onloadCallback = function () {
            grecaptcha.render('g_recaptcha', {
                'sitekey': '{{config("services.google_capcha.key")}}',
                'theme': 'light'
            });
        };
    </script>

@endsection




