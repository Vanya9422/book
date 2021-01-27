<?php

namespace App\Providers;

use App\Services\ServerRenderer;
use Spatie\Ssr\Engine;
use Spatie\Ssr\Engines\Node;
use Spatie\Ssr\Engines\V8;
use Spatie\Ssr\Resolvers\MixResolver;

class SsrServiceProvider extends \Spatie\Ssr\SsrServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(base_path('vendor/spatie/laravel-server-side-rendering/config/ssr.php'), 'ssr');
        
        $this->app->singleton(Node::class, function () {
            return new Node($this->app->config->get('ssr.node.node_path'), $this->app->config->get('ssr.node.temp_path'));
        });
        
        $this->app->singleton(V8::class, function () {
            return new V8(new \V8Js());
        });
        
        $this->app->bind(Engine::class, function () {
            return $this->app->make($this->app->config->get('ssr.engine'));
        });
        
        $this->app->resolving(ServerRenderer::class, function (ServerRenderer $serverRenderer) {
            return $serverRenderer->enabled($this->app->config->get('ssr.enabled'))->debug($this->app->config->get('ssr.debug'))->context('url', $this->app->request->getRequestUri())->context($this->app->config->get('ssr.context'))->env($this->app->config->get('ssr.env'))->resolveEntryWith(new MixResolver($this->app->config->get('ssr.mix')));
        });
        
        $this->app->alias(ServerRenderer::class, 'ssr');
    }
}
