<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token =  JWTAuth::getToken();
        if(!$token){
            return response(["detail" => "Authentication credentials were not provided."], 401);
        }
        try {
            JWTAuth::authenticate($token);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return $next($request);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response([
                'status' => 500,
                'message' => 'Token Invalid',
            ], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response([
                'status' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
        return $next($request);
    }
}
