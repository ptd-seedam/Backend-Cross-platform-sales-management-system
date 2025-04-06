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
            \App\Interfaces\OrderRepositoryInterface::class,
            \App\Repositories\OrderRepository::class,
            \App\Interfaces\OrderItemRepositoryInterface::class,
            \App\Repositories\OrderItemRepository::class,
            \App\Interfaces\UserRepositoryInterface::class,
            \App\Repositories\UserRepository::class,
            \App\Interfaces\CategoryRepositoryInterface::class,
            \App\Repositories\CategoryRepository::class,
            \App\Interfaces\EmployeeRepositoryInterface::class,
            \App\Repositories\EmployeeRepository::class,
            \App\Interfaces\SalaryRepositoryInterface::class,
            \App\Repositories\SalaryRepository::class,
            \App\Interfaces\StoreEmployeeRepositoryInterface::class,
            \App\Repositories\StoreEmployeeRepository::class,
            \App\Interfaces\InventoryRepositoryInterface::class,
            \App\Repositories\InventoryRepository::class,
            \App\Interfaces\StoreRepositoryInterface::class,
            \App\Repositories\StoreRepository::class,
            \App\Interfaces\WarehouseRepositoryInterface::class,
            \App\Repositories\WarehouseRepository::class,
            \App\Interfaces\ProductImageRepositoryInterface::class,
            \App\Repositories\ProductImageRepository::class,
            \App\Interfaces\ProductVarientRepositoryInterface::class,
            \App\Repositories\ProductVarientRepository::class,
            \App\Interfaces\PaymentRepositoryInterface::class,
            \App\Repositories\PaymentRepository::class,
            \App\Interfaces\ShipmentRepositoryInterface::class,
            \App\Repositories\ShipmentRepository::class,
            \App\Interfaces\SyncStatusRepositoryInterface::class,
            \App\Repositories\SyncStatusRepository::class
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
