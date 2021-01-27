<?php

namespace App\Http\Middleware;

use Closure;

class NotFoundIfStaticFileDetected
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
        if ($request->route()->named('main.not_found')) {
            return $next($request);
        }
        
        if ($this->isFilenamePath($request)) {
            return response('Not Found', 404);
        }
        
        return $next($request);
    }
    
    public function isFilenamePath($request)
    {
        return preg_match('/^.+\.(jpg|jpeg|gif|png|ico|css|js|swf|txt|ico|wav|mp3|html|eot|woff|ttf|svg|map)$/', $request->path());
    }
}
