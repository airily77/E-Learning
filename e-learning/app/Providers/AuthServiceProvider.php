<?php

namespace App\Providers;

use App\Extensions\ManagerGuard;
use App\Extensions\UserDataProvider;
use database\connectors\UserData;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Extensions\UserGuard;
use App\Extensions\ManagerDataProvider;
use App\Extensions\Manager;
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
        $this->app->bind('App\Extensions\Manager',function($app){
           return new Manager;
        });

        Auth::provider('manager', function ($app, array $config) {
            return new ManagerDataProvider($app->make('App\Extensions\Manager'));
        });

        Auth::extend('managerguard', function ($app, $name, array $config) {
            return new ManagerGuard(Auth::createManagerProvider($config['provider']));
        });
    }
}
