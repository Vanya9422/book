<?php

namespace App\Http\Middleware;

use Closure;

class ValidateLocale
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
        
        $preferredLocale = $this->getPreferredLocale($request);
        
        if (!in_array($preferredLocale, config('app.available_locales'))) {
            $preferredLocale = app()->getLocale();
        }
        
        if ($preferredLocale != $request->cookie('locale')) {
            cookie()->queue(cookie()->forever('locale', $preferredLocale));
        }
        
        if (!isset($request->route()->parameterNames[0]) || $request->route()->parameterNames[0] != 'locale') {
            app()->setLocale($preferredLocale);
            
            return $next($request);
        }
        
        $routeLocale = $request->route()->parameters['locale'] ?? null;
        
        if (!$routeLocale || strlen($routeLocale) !== 2) {
            $redirectUrl = $request->getPathInfo() . ($request->getQueryString() ? '?' . $request->getQueryString() : '');
            $redirectUrl = '/' . $preferredLocale . preg_replace('/([0-9]+)=/', '$1', $redirectUrl);
            
            return redirect()->to($redirectUrl);
        }
        
        if ($routeLocale != $preferredLocale) {
            $redirectUrl = $request->getPathInfo() . ($request->getQueryString() ? '?' . $request->getQueryString() : '');
            $redirectUrl = substr($redirectUrl, 3);
            $redirectUrl = '/' . $preferredLocale . preg_replace('/([0-9]+)=/', '$1', $redirectUrl);
            
            return redirect()->to($redirectUrl);
        }
        
        app()->setLocale($preferredLocale);
        
        return $next($request);
    }
    
    public function getPreferredLocale($request)
    {
        if (auth()->check()) {
            return auth()->user()->locale;
        }
        
        if (isset($request->route()->parameterNames[0]) && $request->route()->parameterNames[0] == 'locale' && isset($request->route()->parameters['locale']) && in_array(strtolower($request->route()->parameters['locale']), config('app.available_locales'))) {
            return strtolower($request->route()->parameters['locale']);
        }
        
        if ($request->cookie('locale')) {
            return $request->cookie('locale');
        }
        
        if ($request->server('HTTP_ACCEPT_LANGUAGE')) {
            return explode('-', explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'))[0])[0];
        }
        
        return app()->getLocale();
    }
    
    public function isFilenamePath($request)
    {
        return preg_match('/^.+\.(jpg|jpeg|gif|png|ico|css|js|swf|txt|ico|wav|mp3|html|eot|woff|ttf|svg)$/', $request->path());
    }
}
