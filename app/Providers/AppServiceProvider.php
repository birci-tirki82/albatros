<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\CartRepositoryInterface',
            'App\Repositories\CartRepository'
        );
        $this->app->bind(
            'App\Repositories\FavoriteRepositoryInterface',
            'App\Repositories\FavoriteRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
