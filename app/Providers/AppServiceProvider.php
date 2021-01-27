<?php

namespace App\Providers;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->environment() !== 'production') {
            app()->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        if (preg_match('#^https://#i', config('app.url'))) {
            URL::forceScheme('https');
        }
        
        $this->registerRelationMorphMap();
        $this->registerResourceMacros();
        $this->registerRequestMacros();
        $this->registerRouterMacros();
        $this->registerCustomValidationRules();
    }
    
    public function registerRelationMorphMap()
    {
        Relation::morphMap([
            'User' => \App\Models\User\User::class,
            'Team' => \App\Models\Team\Team::class,
            'TeamMember' => \App\Models\Team\TeamMember::class,
            // ...
        ]);
    }
    
    public function registerResourceMacros()
    {
        Response::macro('handle', function ($statusCode = 200) {
            if (request()->ajax()) {
                return $this->json([
                    'initial_state' => store('state'),
                ]);
            }
            
            return $this->view('layout', [], $statusCode);
        });
        
        Response::macro('resource', function ($resource = null, $extra = [], $statusCode = 200) {
            $response = [];
            
            if ($resource instanceof LengthAwarePaginator) {
                $response['data'] = $resource->getCollection();
                
                $response['pagination'] = [
                    'current_page' => $resource->currentPage(),
                    'last_page' => $resource->lastPage(),
                    'per_page' => $resource->perPage(),
                    'count' => $resource->count(),
                    'total' => $resource->total(),
                ];
            } else {
                $response['data'] = $resource;
            }
            
            if (is_array($extra)) {
                $response = array_merge_recursive($response, $extra);
            }
            
            return response()->json($response, $statusCode);
        });
    }
    
    public function registerRequestMacros()
    {
        Request::macro('api', function ($routeName, $routeParams = [], $queryParams = []) {
            $baseRequest = request();
            $baseRequest->replace($queryParams);
            $baseRequestRoute = $baseRequest->route();
            $baseRequestQuery = $baseRequest->input();
            $route = app('router')->getRoutes()->getByName('api.v' . config('api.current_version') . '.' . $routeName);
            $request = Request::create(app('url')->toRoute($route, $routeParams, true));
            
            $baseRequest->setRouteResolver(function () use ($route) {
                return $route;
            });
            
            $response = Route::dispatchToRoute($request);
            app()->instance('request', $baseRequest);
            $baseRequest->replace($baseRequestQuery);
            
            $baseRequest->setRouteResolver(function () use ($baseRequestRoute) {
                return $baseRequestRoute;
            });
            
            if ($response->exception) {
                throw $response->exception;
            }
            
            $responseContent = json_decode($response->getContent());
            $responseContent->error = $responseContent->error ?? null;
            $responseContent->data = $responseContent->data ?? null;
            $responseContent->statusCode = $response->getStatusCode();
            
            if ($responseContent->error) {
                if (config('app.debug')) {
                    echo json_encode($responseContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                    die;
                }
                
                throw new HttpException($responseContent->statusCode, $responseContent->error);
            }
            
            return $responseContent->data;
        });
        
        Request::macro('validate', function ($rules, $messages = []) {
            return validate($this->all(), $rules, null, $messages);
        });
        
        Request::macro('included', function ($relations) {
            foreach ($relations as $relationKey => $relationClosure) {
                if (!is_integer($relationKey)) {
                    continue;
                }
                
                unset($relations[$relationKey]);
                $relations[$relationClosure] = function () {
                };
            }
            
            if (!$this->input('include')) {
                return [];
            }
            
            $includedKeys = $this->input('include');
            
            if (is_string($includedKeys)) {
                $includedKeys = preg_split('/[^a-z0-9_.]/i', $includedKeys);
            }
            
            $relations = array_filter($relations, function ($relationKey) use ($includedKeys) {
                return in_array($relationKey, $includedKeys);
            }, ARRAY_FILTER_USE_KEY);
            
            ksort($relations);
            
            return $relations;
        });
    }
    
    public function registerRouterMacros()
    {
        app('router')->macro('jumpToRoute', function (string $routeName) {
            $request = request();
            $route = $this->getRoutes()->getByName($routeName);
            
            $request->setRouteResolver(function () use ($route) {
                return $route;
            });
            
            return tap($route)->bind($request)->run();
        });
        
        app('router')->macro('getReservedSlugs', function () {
            return array_values(array_unique(array_map(function ($path) {
                return explode('/', preg_replace('/^{locale\?}\/(.*)/', '$1', $path))[0];
            }, array_filter(array_keys($this->getRoutes()->get('GET')), function ($path) {
                return preg_match('/^[0-9a-z_-]+/', $path) || preg_match('/^{locale\?}\/[0-9a-z_-]+/', $path);
            }))));
        });
    }
    
    public function registerCustomValidationRules()
    {
        validator()->extend('current_password', function ($attribute, $value, $parameters, $validator) {
            if (!$user = User::select('password')->find($parameters[0])) {
                return false;
            }
            
            return $user->doesPasswordEqual($value);
        });
    }
}
