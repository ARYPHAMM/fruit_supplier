<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/home', 'AuthController@home')->name('home')->middleware('auth');
// start auth
Route::get('/', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@postLogin')->name('post-login');
Route::get('/logout', 'AuthController@logout')->name('logout')->middleware('auth');
// end auth
// start category
Route::resource('categories', 'CategoryController')->except(['create', 'edit', 'update', 'show'])->middleware('auth');
Route::get('categories/edit/{category?}', 'CategoryController@edit')->name('categories.edit')->middleware('auth');
// end category
// start product
Route::resource('products', 'ProductController')->except(['create', 'edit', 'update', 'show'])->middleware('auth');
Route::get('products/edit/{product?}', 'ProductController@edit')->name('products.edit')->middleware('auth');
Route::get('get-products', 'ProductController@indexJson')->middleware('auth')->name('products.index.json');
// end product
// start order
Route::resource('orders', 'OrderController')->except(['create', 'edit', 'update','show'])->middleware('auth');
Route::get('orders/edit/{order?}', 'OrderController@edit')->name('orders.edit')->middleware('auth');
// Route::get('orders/show/{order?}', 'OrderController@show')->name('orders.show')->middleware('auth');
// end order
