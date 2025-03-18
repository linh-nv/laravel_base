<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => __('Bạn đã đăng nhập!'),
                    'redirect'=>route('clients.index')
                ], JsonResponse::HTTP_FORBIDDEN);
            }
            return redirect()->route('clients.index');
        }
        return $next($request);
    }
}
