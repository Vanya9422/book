<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SwitchGuardToApi
{
    public function handle(Request $request, Closure $next, $defaultGuard = null)
    {
        if (!$request->header('referer')) {
            config(['auth.defaults.guard' => 'api']);
        }
        
        return $next($request);
    }
}
