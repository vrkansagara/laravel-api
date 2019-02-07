<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\interfaces\Acl\Role\RoleRepositoryInterface::class, \App\Repositories\Acl\Role\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Acl\Permission\PermissionRepositoryInterface::class, \App\Repositories\Acl\Permission\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
