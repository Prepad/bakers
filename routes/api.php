<?php

use App\Http\Controllers\AbstractBakingTypeController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')
    ->middleware('api')
    ->group(function() {
        Route::post('/register', [AuthController::class, 'register'])
            ->name('api.auth.register');
        Route::post('/login', [AuthController::class, 'login'])
            ->name('api.auth.login');
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('api.auth.logout');
    });

Route::prefix('baker')
    ->middleware(['auth:api'])
    ->group(function () {
        Route::get('/abstract-baking-types', [AbstractBakingTypeController::class, 'list'])
            ->name('api.baker.abstract-baking-types');
        Route::post('/new-baking-type', [\App\Http\Controllers\BakingTypeController::class, 'makeBakingType'])
            ->name('api.baker.new-baking-type');
        Route::post('/make-bake', [\App\Http\Controllers\BakesController::class, 'makeBake'])
            ->name('api.baker.make-bake');
        Route::get('/orders', [\App\Http\Controllers\OrderController::class, 'orderList'])
            ->name('api.baker.orders');
        Route::put('/order', [\App\Http\Controllers\OrderController::class, 'closeOrder'])
            ->name('api.baker.close-order');
    });

Route::prefix('showcase')
    ->group(function () {
        Route::get('/bakes', [\App\Http\Controllers\BakesController::class, 'bakeList'])
            ->name('api.showcase.bakes');
        Route::post('/order', [\App\Http\Controllers\OrderController::class, 'createOrder'])
            ->name('api.showcase.order');
    });
