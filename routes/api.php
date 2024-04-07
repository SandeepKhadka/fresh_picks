<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
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


Route::post('login', [LoginController::class, 'login']);
Route::post('signup', [LoginController::class, 'signup']);

// Product API
Route::get('getProducts', [ProductController::class, 'getProducts']);
Route::get('getExoticProduct', [ProductController::class, 'getExoticProduct']);
Route::get('getDiscountProduct', [ProductController::class, 'getDiscountProduct']);
Route::get('getNewProduct', [ProductController::class, 'getNewProduct']);

// Banner API
Route::get('getAllBanner', [BannerController::class, 'getAllBanner']);

//Category API
Route::get('getAllCategory', [CategoryController::class, 'getAllCategory']);
Route::get('category/{categoryId}/products', [CategoryController::class, 'getCategoryProducts']);

//Order API
Route::post('storeOrder', [OrderController::class, 'store']);
Route::get('getUserOrders/{user_id}', [OrderController::class, 'getUserOrders']);

//User API

