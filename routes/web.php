<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;


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

Route::get('/', ['App\Http\Controllers\ProductsController','welcome'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('products','App\Http\Controllers\ProductsController');
Route::get('products',['App\Http\Controllers\ProductsController','index'])->middleware(['auth'])->name('products.index');
Route::get('products/create',['App\Http\Controllers\ProductsController','create'])->middleware(['auth'])->name('products.create');
Route::get('pricelist',['App\Http\Controllers\ProductsController','pricelist'])->middleware(['auth'])->name('products.pricelist');
Route::post('products/create',['App\Http\Controllers\ProductsController','store'])->middleware(['auth'])->name('products.store');
Route::post('products/pricelist',['App\Http\Controllers\ProductsController','storeprice'])->middleware(['auth'])->name('products.storeprice');
Route::post('products',['App\Http\Controllers\ProductsController','filter'])->middleware(['auth'])->name('products.filter');
Route::delete('pricelist/{id}',['App\Http\Controllers\ProductsController','destroyprice'])->middleware(['auth'])->name('products.destroyprice');

require __DIR__.'/auth.php';
