<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\ProjectNoteRepository::class, \App\Repositories\ProjectNoteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProjectTaskRepository::class, \App\Repositories\ProjectTaskRepositoryEloquent::class);
        //:end-bindings:
    }
}
