<?php

namespace App\Providers;

use App\Extensions\UserDataProvider;
use database\connectors\UserData;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Extensions\UserGuard;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(){
        $this->registerPolicies();
        $this->app->bind('App\User', function ($app) {
            return new User;
        });

        Auth::provider('user', function ($app, array $config) {
            return new UserDataProvider($app->make('App\User'));
        });
        Auth::extend('userguard', function ($app, $name, array $config) {
            return new UserGuard(Auth::createUserProvider($config['provider']));
        });
    }
}
