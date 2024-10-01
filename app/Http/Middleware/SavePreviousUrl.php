<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SavePreviousUrl
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah ini request dari AJAX atau request PUT/POST untuk update data
        if (!$request->ajax() && !in_array($request->method(), ['PUT', 'POST'])) {
            session(['previous_url' => $request->fullUrl()]);
        }

        return $next($request);
    }
}
