<?php

use App\product;
use Spatie\Permission\Models\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
Route::get('/test', function () {

});

Route::view('/login', 'login');
Route::post('/login', 'UserController@loginSystem')->name('login');
Route::any('/', 'ProductController@index')->name('home');


Route::get('/categories/{tipo}', 'ProductController@index')->name('categories.products');
Route::get('/categories/{id}/{tipo}', 'ProductController@withCategories')->name('products.categories');



Route::view('/register', 'register')->name('register');
Route::post('/register_user/{type}', 'UserController@register')->name('register.user');
Route::get('/productOfCategory/{category_id}', 'ProductController@get')->name('get.products.category');

Route::group(['middleware' => ['auth']], function(){

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
        Route::post('/getProducts', 'ProductController@getProducts')->name('getProducts');
        Route::any('/detalleProducto/{id}', 'ProductController@detalles')->name('DetalleProducto');
        Route::get('/update/{id}', 'ProductController@updateIndex')->name('update.product');
        Route::post('/product/update/{id}', 'ProductController@update');
        Route::any('/delete/{id}', 'ProductController@deleteProduct');
    });

    Route::prefix('User')->group(function () {
        Route::get('/user', 'UserController@index')->name('user');
    });


    Route::view('/factura', 'factura')->name('factura');
});




