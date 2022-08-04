<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'admin']], function (){
    Route::get('/',  [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

    Route::resource('banner', BannerController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
});

Route::group(['prefix'=>'seller', 'middleware'=>['auth', 'seller']], function (){
    Route::get('/',  [App\Http\Controllers\HomeController::class, 'seller'])->name('seller');
});

Route::group(['prefix'=>'customer', 'middleware'=>['auth', 'customer']], function (){
    Route::get('/',  [App\Http\Controllers\HomeController::class, 'customer'])->name('customer');
});
