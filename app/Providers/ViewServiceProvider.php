<?php

namespace App\Providers;

use App\Services\VueServerSideRenderer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    /**
     * Bootstrap services.
     *
     * @param Request $request
     * @return void
     */
    public function boot(Request $request)
    {
        View::composer('layout', function ($view) use ($request) {
            $vueServerSideRenderer = new VueServerSideRenderer('http://127.0.0.1:32452', [
                'route' => [
                    'name' => $request->route()->getName(),
                    'params' => $request->route()->parameters(),
                ],
                
                'url' => $request->getPathInfo(),
                'state' => store('state'),
            ]);
            
            $vueServerSideRenderer->render();
            $view->with($vueServerSideRenderer->toArray());
        });
    }
}
