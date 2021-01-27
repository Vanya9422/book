<?php

namespace App\Http\Middleware;

use Closure;

class CheckEntryPointRoute
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        
        if ($request->route()->named('auth.login', 'auth.register')) {
            if ($user) {
                return redirect()->route($user->entry_point_route);
            }
            
            return $next($request);
        }
        
        if ($request->route()->named('intro.*')) {
            if (!$user) {
                return redirect()->route('auth.login', app()->getLocale());
            }
            
            if ($request->route()->getName() != $user->entry_point_route) {
                return redirect()->route($user->entry_point_route);
            }
            
            return $next($request);
        }
        
        if ($request->route()->named('dashboard.*')) {
            if (!$user) {
                return redirect()->route('auth.login', app()->getLocale());
            }
            
            if ($user->intro_step) {
                return redirect()->route($user->entry_point_route);
            }
            
            return $next($request);
        }
        
        return $next($request);
    }
}
