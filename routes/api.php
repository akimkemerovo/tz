<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'list']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::get('/{categoryId}', [CategoryController::class, 'get']);
    Route::put('/{categoryId}', [CategoryController::class, 'update']);
    Route::delete('/{categoryId}', [CategoryController::class, 'delete']);

});

Route::prefix('products')->group(function() {
    Route::get('/', [ProductController::class, 'list']);
    Route::post('/', [ProductController::class, 'create']);
    Route::get('/{productId}', [ProductController::class, 'get']);
    Route::put('/{productId}', [ProductController::class, 'update']);
    Route::delete('/{productId}', [ProductController::class, 'delete']);

});
