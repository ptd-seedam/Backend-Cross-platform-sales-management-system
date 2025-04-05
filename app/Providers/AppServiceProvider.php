<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\ProductRepositoryInterface::class,
            \App\Repositories\ProductRepository::class,
            \App\Interfaces\IntegrationRepositoryInterface::class,
            \App\Repositories\IntegrationRepository::class,
            \App\Interfaces\OrderItemRepositoryInterface::class,
            \App\Repositories\OrderItemRepository::class,
            \App\Interfaces\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
