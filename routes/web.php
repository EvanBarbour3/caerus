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

Auth::routes();

Route::middleware(['auth'])->namespace('Web')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::prefix('orders')->group(function () {
        Route::get('/', 'OrderController@index')->name('orders');
    });
});
