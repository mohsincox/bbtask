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
Route::get('/product', 'ProductController@index');
Route::get('/product/create', 'ProductController@create');
Route::post('/product/product', 'ProductController@store');

Route::get('/test', 'ProductController@test');
Route::get('/product-title-unique', 'ProductController@titleUnique');
Route::get('/product/delete/{id}', 'ProductController@delete');
Route::get('/product/edit/{id}', 'ProductController@edit');
Route::post('/product/edit/product/update', 'ProductController@update');

Route::get('/category', 'CategoryController@index');
Route::get('/category/create', 'CategoryController@create');
Route::post('/category/store', 'CategoryController@store');
Route::get('/category/edit/{id}', 'CategoryController@edit');
Route::get('/category/delete/{id}', 'CategoryController@delete');

Route::get('/about-us', 'AboutUsController@aboutUs');
Route::get('/category-details', 'CategoryDetailsController@categoryDetails');
Route::get('/contact', 'ContactController@contact');
Route::get('/index', 'IndexController@index');
Route::get('/product-list', 'ProductListController@productList');
