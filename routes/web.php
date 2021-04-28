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

Route::get('/', function () {
    if(Auth::check()) {
        return redirect('admin');
    } else {
        return redirect('admin');
    }
});

Route::get('/goods/{lang}', 'Admin\JsonController@goods');
Route::get('/tracks/{id}', 'Admin\JsonController@tracks');

//Route::get('/', 'Client\HomeController@index')->name('client.home');
//Route::get('/make-json', 'Client\JsonController@index')->name('client.json');


\Route::group(
    ['middleware' => 'auth', 'prefix' => 'admin'],
    function () {
        Route::get('logout', 'Admin\AuthController@logout')->name('admin.logout');
        Route::get('home', 'Admin\HomeController@index')->name('admin.home');

        Route::get('users', 'Admin\UsersController@index')->name('admin.users');
        Route::get('users/add', 'Admin\UsersController@add')->name('admin.users.add');
        Route::post('users/add', 'Admin\UsersController@add');
        Route::get('users/{id}/edit', 'Admin\UsersController@edit')->name('admin.users.edit');
        Route::post('users/{id}/edit', 'Admin\UsersController@edit');
        Route::get('users/{id}/delete', 'Admin\UsersController@delete')->name('admin.users.delete');

        Route::get('goods', 'Admin\GoodsController@index')->name('admin.goods');
        Route::get('goods/add', 'Admin\GoodsController@add')->name('admin.goods.add');
        Route::post('goods/add', 'Admin\GoodsController@add');
        Route::get('goods/{id}/edit', 'Admin\GoodsController@edit')->name('admin.goods.edit');
        Route::post('goods/{id}/edit', 'Admin\GoodsController@edit');
        Route::get('goods/{id}/delete', 'Admin\GoodsController@delete')->name('admin.goods.delete');

        Route::get('deliveries', 'Admin\DeliveriesController@index')->name('admin.deliveries');
        Route::get('remains', 'Admin\DeliveriesController@remains')->name('admin.remains');
        Route::get('deliveries/add', 'Admin\DeliveriesController@add')->name('admin.deliveries.add');
        Route::post('deliveries/add', 'Admin\DeliveriesController@add');
        Route::get('deliveries/{id}/edit', 'Admin\DeliveriesController@edit')->name('admin.deliveries.edit');
        Route::post('deliveries/{id}/edit', 'Admin\DeliveriesController@edit');
        Route::get('deliveries/{id}/delete', 'Admin\DeliveriesController@delete')->name('admin.deliveries.delete');
    }
);

Route::group(
    ['middleware' => 'guest', 'prefix' => 'admin'],
    function () {
        Route::get('', 'Admin\AuthController@showLoginForm')->name('login');
        Route::post('', 'Admin\AuthController@authenticate')->name('authenticate');
        Route::get('/register', 'Admin\AuthController@showRegisterForm')->name('register');
        Route::post('', 'Admin\AuthController@register')->name('register.auth');
    }
);