<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequests\Auth\LoginRequest;
use App\Http\Requests\ClientRequests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use App\TraitHelpers\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view(parent::CLIENT_VIEW . 'guest.login');
    }

    public function signIn(LoginRequest $request)
    {   $request->merge(['phone'=>$request->username]);
        $logged = $this->authService->login($request->only('phone', 'password'));
        if ($logged) {
            $userLogged = \Auth::user();
            if ($userLogged->isActive()) {
                $route = route('clients.dashboard');
                return $this->handleExecuteActionResponse(true, __(':attribute thành công!', ['attribute' => 'Đăng nhập']), ['redirect' => $route]);
            }
            $this->logout();
            return $this->handleExecuteActionResponse(false, __('Tài khoản của bạn đã bị khóa, vui lòng liên hệ admin để được giải quyết'));
        }
        return $this->handleExecuteActionResponse(false, __('Tài khoản hoặc mật khẩu không đúng, vui lòng thử lại'));
    }

    public function logout()
    {
        $this->authService->logout(['web']);
        return redirect()->route('clients.index');
    }

    public function register()
    {
        return view(parent::CLIENT_VIEW . 'guest.register');
    }

    public function signUp(RegisterRequest $request)
    {
        $registerSuccess = $this->authService->register($request->only(['name', 'email', 'password']), $request->affiliate_key);
        /*        if (\Cookie::get('af')){
                    return \Cookie::get('af');
                }*/
        if ($registerSuccess) {
            $this->authService->login($request->only('email', 'password'));
            return $this->handleExecuteActionResponse(true, __(':attribute thành công!', ['attribute' => 'Đăng ký']), ['redirect' => route('clients.orders.create')]);
        }
        return $this->handleExecuteActionResponse(false, __('Đã xảy ra lỗi vui lòng liên hệ admin.'));
    }
}
