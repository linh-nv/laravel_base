<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class IntermediateUser
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
        if ($request->userLogged->isIntermediateUser() || $request->userLogged->isAdmin()) {
            return $next($request);
        }
        if ($request->ajax()) {
            return response()->json([
                'message' => __('Bạn không có quyền truy cập trang này'),
                'redirect' => route('clients.target_transactions.index'),
            ], JsonResponse::HTTP_FORBIDDEN);
        }
        abort(JsonResponse::HTTP_FORBIDDEN);
    }
}
