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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'HomeController@view');
Route::get('/cabinet', 'HomeController@cabinet')->name('cabinet');



//SHOP
Route::get('/shop', 'ShopController@index')->name('my_shop');
Route::post('/shop/create', 'ShopController@create')->name('shop_create');
//Нова обнова
Route::get('/shop/obnova/create', 'ShopController@newObnova')->name('create_obnova');
Route::post('/shop/obnova/create', 'ShopController@createObnova')->name('create_obnova_action');

Route::get('/test', 'ShopController@test');
Route::post('/test', 'ShopController@testPost');

Route::get('/search', 'HomeController@search') -> name('search');