<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\Auth\AdminAuthController;
use App\Http\Controllers\Api\Auth\LoginAuthController;
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


Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::group([
    'prefix' => 'userAuth'

], function ($router) {
    Route::post('/login', [LoginAuthController::class, 'login']);
    Route::post('/register', [LoginAuthController::class, 'register']);
    Route::post('/logout', [LoginAuthController::class, 'logout']);
    Route::post('/refresh', [LoginAuthController::class, 'refresh']);
    Route::get('/user-profile', [LoginAuthController::class, 'userProfile']);
});

Route::group([
    'prefix' => 'adminAuth'

], function ($router) {
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout']);
    Route::post('/refresh', [AdminAuthController::class, 'refresh']);
    Route::get('/user-profile', [AdminAuthController::class, 'userProfile']);
});

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth:api_admin');
