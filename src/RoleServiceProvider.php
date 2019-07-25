<?php

namespace Surya\Role;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class RoleServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services
     *
     * @return  void
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__) . '/database/migrations' => database_path('migrations')
        ], 'migrations');

        Gate::before(function($user, $ability) {
            return $user->hasPermission($ability);
        });
    }

    /**
     * Register any application services
     *
     * @return  void
     */
    public function register()
    {

    }

}