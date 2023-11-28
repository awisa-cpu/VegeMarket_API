<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/categories',[CategoryController::class, 'categories']);

Route::post('/newCategory',[CategoryController::class, 'create']);

//products

Route::get('/products', [ProductController::class, 'products']);

Route::get('/product/{id}', [ProductController::class, 'product']);

Route::post('/newProduct', [ProductController::class, 'createProduct']);

Route::put('/updateProduct/{id}', [ProductController::class, 'update']);

Route::delete('/deleteProduct/{id}',[ProductController::class, 'delete']);