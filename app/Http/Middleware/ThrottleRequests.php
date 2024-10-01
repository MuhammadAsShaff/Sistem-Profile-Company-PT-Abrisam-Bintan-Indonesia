<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ThrottleRequests
{
    public function handle(Request $request, Closure $next, $maxAttempts = 3, $decayMinutes = 1)
    {
        $key = $request->email_admin . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'message' => 'Too many login attempts. Please try again in ' . $seconds . ' seconds.'
            ], 429);
        }

        RateLimiter::hit($key, $decayMinutes);

        return $next($request);
    }
}
