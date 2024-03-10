<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!is_null(auth('api')->user())) {
            auth('api')->user()->update(['last_active' => Carbon::now()]);
        }
        if (!is_null(auth('store_api')->user())) {
            auth('store_api')->user()->update(['last_active' => Carbon::now()]);
        }
        return $next($request);
    }
}
