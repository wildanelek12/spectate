<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthApiKey
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
        $key = $request->header('x-api-key');

        if ($key === env('X_API_KEY')) {
            return $next($request);
        } else {
            return abort(response()->json([
                'success' => false,
                'message' => 'Unauthorized!'
            ], Response::HTTP_UNAUTHORIZED));
        }
    }
}
