<?php

namespace App\Providers;

use App\Models\BookingPage\BookingPage;
use App\Models\BookingType\BookingType;
use App\Models\User\User;
use App\Policies\BookingPagePolicy;
use App\Policies\BookingTypePolicy;
use App\Policies\UserPolicy;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        BookingPage::class => BookingPagePolicy::class,
        BookingType::class => BookingTypePolicy::class,
    ];
    
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Session $session)
    {
        $this->registerPolicies();
        
        Auth::extend('session', function ($app, $name, array $config) use ($session) {
            $provider = Auth::createUserProvider($config['provider'] ?? null);
            $guard = new \App\Auth\SessionGuard($name, $provider, $this->app['session.store']);
            
            if (method_exists($guard, 'setCookieJar')) {
                $guard->setCookieJar($this->app['cookie']);
            }
            
            if (method_exists($guard, 'setDispatcher')) {
                $guard->setDispatcher($this->app['events']);
            }
            
            if (method_exists($guard, 'setRequest')) {
                $guard->setRequest($this->app->refresh('request', $guard, 'setRequest'));
            }
            
            return $guard;
        });
        
        Passport::routes();
        Passport::personalAccessTokensExpireIn(Carbon::now()->addHours(24));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
