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
                                    <h5 class="text-uppercase font-bold m-b-5 m-t-50">{{__('Đăng ký')}}</h5>
                                    <p class="m-b-0">{{__('Đăng ký tài khoản của bạn.')}}</p>
                                </div>
                                <div class="account-content">
                                    <form id="js_register_form" class="form-horizontal needs-validation js-auth-form"
                                          action="{{route('clients.sign_up')}}" method="POST" novalidate>

                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label for="name">{{__('Tên')}}</label>
                                                <input class="form-control" type="text" name="name" placeholder="{{__('Nhập vào tên của bạn.')}}" required>
                                                <div class="invalid-feedback"
                                                     error-for="name">{{__('Tên không hợp lệ')}}</div>
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label for="email">{{__('Email')}}</label>
                                                <input class="form-control" type="email" name="email" required
                                                       placeholder="{{__('Nhập vào email.')}}">
                                                <div class="invalid-feedback"
                                                     error-for="email">{{__('Email không hợp lệ')}}</div>
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label for="password">{{__('Mật khẩu')}}</label>
                                                <input class="form-control" type="password" required name="password"
                                                       placeholder="{{__('Nhập vào mật khẩu.')}}">
                                                <div class="invalid-feedback"
                                                     error-for="password">{{__('Vui lòng nhập mật khẩu')}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label for="password">{{__('Nhập lại mật khẩu')}}</label>
                                                <input class="form-control" type="password" required name="re_password"
                                                       placeholder="{{__('Nhập lại mật khẩu.')}}">
                                                <div class="invalid-feedback"
                                                     error-for="re_password">{{__('Vui lòng nhập mật khẩu')}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <label for="password">{{__('Mã người giới thiệu')}}</label>
                                                <input class="form-control" type="text" required name="affiliate_key"
                                                       placeholder="{{__('Nhập mã người giới thiệu nếu có.')}}">
                                                <div class="invalid-feedback"
                                                     error-for="affiliate_key">{{__('Mã người giới thiệu không hợp lệ')}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <div class="checkbox checkbox-success">
                                                    <input id="approve" type="checkbox" name="approve" value="yes">
                                                    <label for="approve">
                                                        Tôi đồng ý với <a href="#"> các điều khoản và điều kiện</a>
                                                    </label>
                                                    <div class="invalid-feedback"
                                                         error-for="approve">{{__('Bạn chưa đồng ý với các điều khoản của chúng tôi.')}}</div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <div id="g_recaptcha"></div>
                                                <div class="invalid-feedback"
                                                     error-for="g_recaptcha">{{__('Vui lòng xác nhận bạn không phải là máy')}}</div>
                                            </div>
                                        </div>
                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">{{__('Đăng ký')}}</button>
                                            </div>
                                        </div>

                                    </form>


                                    <div class="row m-t-50">
                                        <div class="col-12 text-center">
                                            <p class="text-muted">{{__('Bạn đã có tài khoản?')}}  <a href="{{route('clients.login')}}" class="text-dark m-l-5"><b>{{__('Đăng nhập')}}</b></a></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- end card-box-->
                        </div>


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




