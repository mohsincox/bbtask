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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    Auth::logout();
    return view('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/forgot-password', 'ForgotPasswordController@index');

Route::get('/login-error', 'ForgotPasswordController@loginError');

/*For user operation*/
Route::get('users','UserController@userList');
Route::get('user_details/{id}','UserController@userDetails');


/*mohsin*/
Route::get('/new-request', 'NewRequestController@index');
Route::post('/store-new-request', 'NewRequestController@storeData');
Route::get('user-sign-up', 'UserSignUpController@index');
Route::get('user-sign-up-form/{id}', 'UserSignUpController@create');
Route::post('sign-up-usa-user', 'UserSignUpController@signUpUsaUser');