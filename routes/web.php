<?php

use App\product;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Factura;



Route::get('/test', function () {
    return auth()->user()->facturas->where('id', '1');
});


Route::view('/login', 'access/login');
Route::post('/login', 'UserController@loginSystem')->name('login');
Route::any('/', 'ProductController@index')->name('home');


Route::get('/categories/{tipo}', 'ProductController@index')->name('categories.products');
Route::get('/categories/{id}/{tipo}', 'ProductController@withCategories')->name('products.categories');



Route::view('/register', 'access/register')->name('register');
Route::post('/register_user/{type}', 'UserController@register')->name('register.user');
Route::get('/productOfCategory/{category_id}', 'ProductController@get')->name('get.products.category');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/logout', 'UserController@logout')->name('logout');

    Route::prefix('Category')->group(function () {
        Route::any('/category', 'CategoryController@index')->name('category');
        Route::any('/delete/{category}', 'CategoryController@delete')->name('category.delete');
        Route::any('/update/{category}', 'CategoryController@update')->name('category.update');
        Route::post('/store', 'CategoryController@store')->name('category.store');
    });

    Route::prefix('Product')->group(function () {
        Route::any('/filtrado', 'ProductController@IndexT');
        Route::get('/product/{tipo}', 'ProductController@index')->name('product');
        Route::post('/store', 'ProductController@store')->name('product.add');
        Route::any('/detalleProducto/{id}', 'ProductController@detalles')->name('DetalleProducto');
        Route::get('/edit/{id}', 'ProductController@edit')->name('update.product');
        Route::post('/update/{product}', 'ProductController@update');
        Route::any('/delete/{product}', 'ProductController@delete');
    });

    Route::prefix('Factura')->group(function () {
        Route::post('/store/{product}', 'FacturaController@store')->name('factura.store');
        Route::view('/carrito', 'default/carrito/carrito')->name('carrito');
        Route::get('/index', 'FacturaController@index')->name('index');
        Route::post('/updateCantidad/{factura}', 'FacturaController@updateCantidad');
        Route::post('/deleteProducto/{factura}', 'FacturaController@deleteProducto');
        Route::get('/Finalizar/{factura}', 'FacturaController@finalizar');
    });

    Route::prefix('User')->group(function () {
        Route::get('/user', 'UserController@index')->name('user');
        Route::get('/delete/{User}', 'UserController@delete')->name('user.delete');
    });


    Route::view('/factura', 'factura')->name('factura');
});
