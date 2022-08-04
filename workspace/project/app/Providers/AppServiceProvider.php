<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\UserServiceInterface',
            'App\Services\UserService'
        );

        $this->app->bind(
            'App\Contracts\NoteServiceInterface',
            'App\Services\NoteService'
        );

        $this->app->bind(
            'App\Contracts\TodoServiceInterface',
            'App\Services\TodoService'
        );
    }
}
