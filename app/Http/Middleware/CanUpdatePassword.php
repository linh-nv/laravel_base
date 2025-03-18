<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class CanUpdatePassword
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
      if ($request->route('id')==null||$request->userLogged->hasPermissionTo('edit users')){
          return $next($request);
      }
        if ($request->ajax()) {
            return response()->json([
                'message' => __('Bạn không có quyền truy cập trang này'),
                'redirect' => route('clients.dashboard'),
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        abort(JsonResponse::HTTP_FORBIDDEN);
    }
}
