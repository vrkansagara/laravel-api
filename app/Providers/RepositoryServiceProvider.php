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
        $this->app->bind(\App\Repositories\interfaces\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\RoleRepository::class, \App\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\PermissionRepository::class, \App\Repositories\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\TokenRepository::class, \App\Repositories\TokenRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\ErrorRepository::class, \App\Repositories\ErrorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Blog\BlogRepository::class, \App\Repositories\BlogRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Blog\BlogRepository::class, \App\Repositories\BlogRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Blog\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Blog\TagRepository::class, \App\Repositories\TagRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Blog\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Blog\TagRepository::class, \App\Repositories\TagRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Blog\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\interfaces\Blog\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
