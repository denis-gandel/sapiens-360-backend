<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $except = [
            'api/auth/login',
            'api/academics/*',
            'api/users',
            'api/auth/role-permissions/initialize/*'
        ];

        if ($request->is($except)) {
            return $next($request);
        }

        Log::info('Cookies recibidas', $request->cookies->all());

        $token = $request->cookie('sapiens_360_gwEjbpFRQsyFZm4VVYBTSk5zP7DmM9tpzAAmW1f4FvndB2HvJmyKytdFYkq2bK53');

        Log::info('Token recibido', ['token' => $token]);

        if (!$token) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        try {
            $decode = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            $request->attributes->add([
                'user_id' => $decode->user_id,
                'tenant_id' => $decode->tenant_id
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }

        return $next($request);
    }
}
