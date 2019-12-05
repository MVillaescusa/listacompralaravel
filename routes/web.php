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

Route::get('/', 'HomeController@getHome');

Route::group(['prefix' => 'productos', 'middleware' => 'auth'], function () {

    Route::get('/categorias', 'ProductoController@getCategorias');

    Route::get('/{categoria?}', 'ProductoController@getIndex');

    Route::get('/show/{id}', 'ProductoController@getShow')
        ->where('id', '[0-9]+');

    Route::get('/create', 'ProductoController@getCreate');
    Route::post('/create', 'ProductoController@postCreate');

    Route::get('/edit/{id}', 'ProductoController@getEdit')
        ->where('id', '[0-9]+');
    Route::put('/edit', 'ProductoController@putEdit');

    Route::put('changeSelled', 'ProductoController@changeSelled');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
