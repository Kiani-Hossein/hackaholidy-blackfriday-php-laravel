<?php

use App\Http\Controllers\Api\V1\BasketController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('blackfriday')->group(function () {
        Route::post('/add-item-to-basket', [BasketController::class, 'addToBasket']);
        Route::post('/checkout-basket', [BasketController::class, 'checkoutBasket']);
        Route::get('/categories', [ProductController::class, 'categories']);
        Route::get('/items/{id}', [ProductController::class, 'show']);
        Route::get('/categories/{category}', [ProductController::class, 'byCategory']);
    });
});
