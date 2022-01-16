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

// ログイン画面を表示
Route::get('/login', 'LoginController@showLogin')->name('login');

// ログイン
Route::post('/user', 'LoginController@exeUser')->name('user');

// 新規登録画面を表示
Route::get('/register', 'RegisterController@showRegister')->name('register');

// 新規登録
Route::post('/signup', 'RegisterController@exeRegister')->name('signup');

// 商品一覧画面を表示
Route::get('/product', 'ProductController@showList')->name('products');

// 商品登録画面を表示
Route::get('/product/create', 'ProductController@showCreate')->name('create');

// 商品登録
Route::post('/product/store', 'ProductController@exeStore')->name('store');

// 商品詳細画面を表示
Route::get('/product/detail/{id}', 'ProductController@showDetail')->name('detail');

// 商品編集画面を表示
Route::get('/product/edit/edit/{id}', 'ProductController@showEdit')->name('edit');

// 商品更新
Route::post('/product/update', 'ProductController@exeUpdate')->name('update');

// 商品削除
Route::post('/product/delete/{id}', 'ProductController@exeDelete')->name('delete');

// ログアウト
Route::get('/logout', 'ProductController@getLogout')->name('logout');