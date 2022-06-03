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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('products','App\Http\Controllers\ProductsController');
Route::get('products/create',['App\Http\Controllers\ProductsController','create'])->name('products.create');
Route::get('pricelist',['App\Http\Controllers\ProductsController','pricelist'])->name('products.pricelist');
Route::post('products/create',['App\Http\Controllers\ProductsController','store'])->name('products.store');
Route::post('products/pricelist',['App\Http\Controllers\ProductsController','storeprice'])->name('products.storeprice');
Route::post('products',['App\Http\Controllers\ProductsController','filter'])->name('products.filter');


require __DIR__.'/auth.php';
