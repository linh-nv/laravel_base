<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\JsonResponse;

class CheckUserLogged
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Thao tác này yêu cầu đăng nhập!',
                    'redirect' => route('clients.login'),
                ], JsonResponse::HTTP_UNAUTHORIZED);
            }
            return redirect()->route('clients.login');
        } else {
            $userLogged = Auth::user();
            $request->merge(['userLogged' => $userLogged]);
            return $next($request);

        }
    }
}
