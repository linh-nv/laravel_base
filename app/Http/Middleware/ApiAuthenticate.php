<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthService;
use Closure;
use Illuminate\Http\JsonResponse;

class ApiAuthenticate
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $verified = $this->authService->verifyApiAuthentication($request->uid, $request->api_token);
        if ($verified && $verified->isActive()) {
            return $next($request);
        }
        return response()->json([
            'status' => false,
            'message' => __('Xác thực api không thành công'),
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
