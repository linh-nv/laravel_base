<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Auth;

class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->userLogged->isActive()) {
            return $next($request);
        }
        if ($request->ajax()) {
            return response()->json([
                'message' => __('Tài khoản của bạn đã bị khóa, vui lòng liên hệ admin để được giải quyết'),
                'redirect' => route('clients.logout'),
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        return redirect()->route('clients.logout');
    }
}
