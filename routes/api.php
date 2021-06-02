<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth:api_admin');

Route::prefix('/categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('/{category}', [CategoryController::class, 'show']);

    Route::middleware('auth:api_admin')->group(function () {
        Route::post('', [CategoryController::class, 'store']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });
});



