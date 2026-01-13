<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contact', [ContactController::class, 'store']);

// Public endpoints
Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::get('products/category/{category}', [ProductController::class, 'byCategory']);

// Protected endpoints
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('banners', BannerController::class);
    Route::get('contacts', [ContactController::class, 'index']);
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
