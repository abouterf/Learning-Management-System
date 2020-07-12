<?php

namespace abouterf\User\Providers;
use abouterf\User\Models\User;
use Carbon\Laravel\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        config()->set('auth.providers.users.model',User::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/user-routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__.'/../Database/Factories');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','User');
    }
}
