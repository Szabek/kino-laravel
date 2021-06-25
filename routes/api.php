<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\ScreeningController;
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

Route::prefix('/categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('/{category}', [CategoryController::class, 'show']);

    Route::middleware('auth:api_admin')->group(function () {
        Route::post('', [CategoryController::class, 'store']);
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });
});

Route::prefix('/movies')->group(function () {
    Route::get('', [MovieController::class, 'index']);
    Route::get('/{movie}', [MovieController::class, 'show']);

    Route::middleware('auth:api_admin')->group(function () {
        Route::post('', [MovieController::class, 'store']);
        Route::put('/{movie}', [MovieController::class, 'update']);
        Route::delete('/{movie}', [MovieController::class, 'destroy']);
    });
});

Route::prefix('/rooms')->group(function () {
    Route::get('', [RoomController::class, 'index']);
    Route::get('/{room}', [RoomController::class, 'show']);

    Route::middleware('auth:api_admin')->group(function () {
        Route::post('', [RoomController::class, 'store']);
        Route::put('/{room}', [RoomController::class, 'update']);
        Route::delete('/{room}', [RoomController::class, 'destroy']);
    });
});

Route::prefix('/screenings')->group(function () {
    Route::get('', [ScreeningController::class, 'index']);
    Route::get('/{screening}', [ScreeningController::class, 'show']);

    Route::middleware('auth:api_admin')->group(function () {
        Route::post('', [ScreeningController::class, 'store']);
        Route::put('/{screening}', [ScreeningController::class, 'update']);
        Route::delete('/{screening}', [ScreeningController::class, 'destroy']);
    });
});




