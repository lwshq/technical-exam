<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'App\Contracts\NoteRepositoryInterface',
            'App\Repositories\Eloquent\NoteRepository'
        );

        $this->app->bind(
            'App\Contracts\TodoRepositoryInterface',
            'App\Repositories\Eloquent\TodoRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
