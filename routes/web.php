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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::prefix("/product")->group(function() {
        // 商品一覧
        Route::get('showlist', 'ProductController@showList')->name('product.list');
        Route::post('showlist', 'ProductController@productSearch')->name('product.search');
        Route::post('delete/{id}', 'ProductController@productDelete')->name('product.delete');

        // 新規登録
        Route::get('newregistration', 'ProductController@showForm')->name('product.showForm');
        Route::post('newregistration', 'ProductController@newRegistration')->name('product.newregistration');

        // 商品詳細
        Route::post('showdetail/{id}', 'ProductController@showDetail')->name('product.showdetail');

        // 商品編集
        Route::post('edit/{id}', 'ProductController@optionView')->name('product.view');
        Route::patch('update/{id}', 'ProductController@productEdit')->name('product.edit')->name('product.update');
    });
});
