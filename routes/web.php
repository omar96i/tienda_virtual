<?php

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
Route::any('/', 'ProductController@indexH')->name('home');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::any('/category', 'CategoryController@index')->name('category');
Route::any('/product', 'ProductController@index')->name('product');
Route::post('/product/insert', 'ProductController@store')->name('product.add');
Route::post('/product/getProducts', 'ProductController@getProducts')->name('getProducts');
Route::any('/filtrado', 'ProductController@IndexT')->name('Product1');
Route::any('/category/delete/{Category}', 'CategoryController@delete')->name('category.delete');
Route::any('/category/update/{Category}', 'CategoryController@update')->name('category.update');
Route::post('/register_user', 'UserController@register')->name('register.user');
Route::post('/register_category', 'CategoryController@store');
Route::get('/test/{variable}', 'ProductController@edit_product');
Route::any('/detalleProducto/{id}', 'ProductController@detalles')->name('DetalleProducto');
Route::view('/factura', 'factura')->name('factura');


