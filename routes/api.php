<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\Integration\IntegrationController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\OrderItemController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\Store\Category\CategoryController;
use App\Http\Controllers\Api\Store\Employee\EmployeeController;
use App\Http\Controllers\Api\Store\Inventory\InventoryController;
use App\Http\Controllers\API\Store\Payment\PaymentController;
use App\Http\Controllers\Api\Store\ProductController;
use App\Http\Controllers\API\Store\ProductImage\ProductImageController;
use App\Http\Controllers\API\Store\ProductVarient\ProductVarientController;
use App\Http\Controllers\API\Store\Shipment\ShipmentController;
use App\Http\Controllers\API\Store\Store\StoreController;
use App\Http\Controllers\Api\Store\StoreEmployee\StoreEmployeeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
});

Route::middleware(['auth:api'])->group(function () {
    // ỉnwegrations
    Route::prefix('inventories')->group(function () {
        Route::get('/', [IntegrationController::class, 'index']);
        Route::post('/', [IntegrationController::class, 'store']);
        Route::delete('/{id}', [IntegrationController::class, 'destroy']);
    });

    // user
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    // categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
    // products
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
    });
    // employee
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::get('/{id}', [EmployeeController::class, 'show']);
        Route::post('/', [EmployeeController::class, 'store']);
        Route::put('/{id}', [EmployeeController::class, 'update']);
        Route::delete('/{id}', [EmployeeController::class, 'destroy']);
    });
    // salary
    Route::prefix('salaries')->group(function () {
        Route::get('/', [SalaryController::class, 'index']);
        Route::get('/{id}', [SalaryController::class, 'show']);
        Route::post('/', [SalaryController::class, 'store']);
        Route::put('/{id}', [SalaryController::class, 'update']);
        Route::delete('/{id}', [SalaryController::class, 'destroy']);
    });
    // store employee
    Route::prefix('store_employees')->group(function () {
        Route::get('/', [StoreEmployeeController::class, 'index']);
        Route::get('/{id}', [StoreEmployeeController::class, 'show']);
        Route::post('/', [StoreEmployeeController::class, 'store']);
        Route::put('/{id}', [StoreEmployeeController::class, 'update']);
        Route::delete('/{id}', [StoreEmployeeController::class, 'destroy']);
    });

    // inventory
    Route::prefix('inventories')->group(function () {
        Route::get('/', [InventoryController::class, 'index']);
        Route::get('/{id}', [InventoryController::class, 'show']);
        Route::post('/', [InventoryController::class, 'store']);
        Route::put('/{id}', [InventoryController::class, 'update']);
        Route::delete('/{id}', [InventoryController::class, 'destroy']);
    });
    // store
    Route::prefix('stores')->group(function () {
        Route::get('/', [StoreController::class, 'index']);
        Route::get('/{id}', [StoreController::class, 'show']);
        Route::post('/', [StoreController::class, 'store']);
        Route::put('/{id}', [StoreController::class, 'update']);
        Route::delete('/{id}', [StoreController::class, 'destroy']);
    });
    // warehouse
    Route::prefix('warehouses')->group(function () {
        Route::get('/', [WarehouseController::class, 'index']);
        Route::get('/{id}', [WarehouseController::class, 'show']);
        Route::post('/', [WarehouseController::class, 'store']);
        Route::put('/{id}', [WarehouseController::class, 'update']);
        Route::delete('/{id}', [WarehouseController::class, 'destroy']);
    });
    // order
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/{id}', [OrderController::class, 'show']);
        Route::post('/', [OrderController::class, 'store']);
        Route::put('/{id}', [OrderController::class, 'update']);
        Route::delete('/{id}', [OrderController::class, 'destroy']);
    });
    // orderItem
    Route::prefix('order_items')->group(function () {
        Route::get('/', [OrderItemController::class, 'index']);
        Route::get('/{id}', [OrderItemController::class, 'show']);
        Route::post('/', [OrderItemController::class, 'store']);
        Route::put('/{id}', [OrderItemController::class, 'update']);
        Route::delete('/{id}', [OrderItemController::class, 'destroy']);
    });
    // ProductVarient
    Route::prefix('product_varients')->group(function () {
        Route::get('/', [ProductVarientController::class, 'index']);
        Route::get('/{id}', [ProductVarientController::class, 'show']);
        Route::post('/', [ProductVarientController::class, 'store']);
        Route::put('/{id}', [ProductVarientController::class, 'update']);
        Route::delete('/{id}', [ProductVarientController::class, 'destroy']);
    });
    // ProductImage
    Route::prefix('product_images')->group(function () {
        Route::get('/', [ProductImageController::class, 'index']);
        Route::get('/{id}', [ProductImageController::class, 'show']);
        Route::post('/', [ProductImageController::class, 'store']);
        Route::put('/{id}', [ProductImageController::class, 'update']);
        Route::delete('/{id}', [ProductImageController::class, 'destroy']);
    });
    // shipment
    Route::prefix('shipments')->group(function () {
        Route::get('/', [ShipmentController::class, 'index']);
        Route::get('/{id}', [ShipmentController::class, 'show']);
        Route::post('/', [ShipmentController::class, 'store']);
        Route::put('/{id}', [ShipmentController::class, 'update']);
        Route::delete('/{id}', [ShipmentController::class, 'destroy']);
    });
    // Payment
    Route::prefix('payments')->group(function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::get('/{id}', [PaymentController::class, 'show']);
        Route::post('/', [PaymentController::class, 'store']);
        Route::put('/{id}', [PaymentController::class, 'update']);
        Route::delete('/{id}', [PaymentController::class, 'destroy']);
    });
    // SyncStatus
});
