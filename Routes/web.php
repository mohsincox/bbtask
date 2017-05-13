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


Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::post('/forgot-password', 'ForgotPasswordController@index');

Route::get('/login-error', 'ForgotPasswordController@loginError');

/*For user operation*/
Route::get('users','UserController@userList');
Route::get('user_details/{id}','UserController@userDetails');
Route::post('search_user','UserController@searchUser');
Route::post('update_user','UserController@updateUser');
Route::post('delete_user','UserController@deleteUser');
Route::post('set_user_permission','UserController@setUserPermission');

Route::get('/new-request', 'NewRequestController@index');
Route::post('/store-new-request', 'NewRequestController@storeData');

Route::get('sign-up/{tokenEncript}', 'UserSignUpController@create');
Route::post('sign-up-usa-user', 'UserSignUpController@signUpUsaUser');
Route::post('sign-up-supplier', 'UserSignUpController@signUpSupplier');

/*For customer operation*/
Route::get('customers','CustomerController@customerList');
Route::post('search_customer','CustomerController@searchCustomer');
Route::post('update_customer','CustomerController@updateCustomer');
Route::post('delete_customer','CustomerController@deleteCustomer');
Route::post('get_customer_AJAX','CustomerController@getCustomerAjax');
Route::post('filter_customer_info_AJAX','CustomerController@filterCustomerInfoAjax');

/*For product operation*/
Route::get('products','ProductController@productList');
Route::get('add_product','ProductController@addProduct');
Route::post('insert_product','ProductController@insertProduct');
Route::post('search_product','ProductController@searchProduct');
Route::get('product_details/{id}','ProductController@productDetails');
Route::post('update_product','ProductController@updateProduct');
Route::post('delete_product','ProductController@deleteProduct');

/*For sales contractr operation*/
Route::get('sales_contracts','SalesContractController@salesContractList');
Route::get('add_sales_contract','SalesContractController@addSalesContract');
Route::post('search_sales_contract','SalesContractController@searchSalesContract');
Route::post('delete_sales_contract','SalesContractController@deleteSalesContract');
Route::post('get_contract_by_status','SalesContractController@getSalesContractByStatus');
Route::post('upload_temp_file','SalesContractController@uploadTempFile');
Route::post('get_item_AJAX','SalesContractController@getItemAJAX');
Route::post('save_sales_contract','SalesContractController@saveSalesContract');
Route::get('sales_contract_details/{id}','SalesContractController@salesContractDetails');
Route::post('update_sales_contract','SalesContractController@updateSalesContract');

/*For purchase order*/
Route::get('purchase_order', 'PurchaseOrderController@index');
Route::get('purchase_order_details', 'PurchaseOrderController@details');
Route::post('purchase_order_details_store', 'PurchaseOrderController@detailsStore');
Route::get('purchase_order_details_edit/{id}', 'PurchaseOrderController@detailsEdit');
Route::post('purchase_order_details_update', 'PurchaseOrderController@detailsUpdate');

/*Error page*/
Route::get('error403','ErrorController@not_permitted');

/*For admin dashboard*/
Route::post('delete_sales_contract','HomeController@deleteSalesContract');
Route::post('format_sales_contract_list','HomeController@formatSalesContractList');

/*For profile update*/
Route::get('profile_update', 'ProfileUpdateController@index');
Route::post('update-usa-user_profile', 'ProfileUpdateController@updateUsaUserProfile');
Route::post('update_supplier_profile', 'ProfileUpdateController@updateSupplierProfile');

