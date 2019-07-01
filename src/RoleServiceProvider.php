<?php

namespace Surya\Role;

use Illuminate\Support\ServiceProvider;

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