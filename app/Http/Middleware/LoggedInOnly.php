<?php

namespace App\Http\Middleware;

use Closure;

class LoggedInOnly
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            abort(401);
        }
        
        return $next($request);
    }
}
