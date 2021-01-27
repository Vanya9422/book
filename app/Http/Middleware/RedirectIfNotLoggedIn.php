<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotLoggedIn
{
    public function handle($request, Closure $next, $path = '/')
    {
        if (!auth()->check()) {
            return redirect($path);
        }
        
        return $next($request);
    }
}
