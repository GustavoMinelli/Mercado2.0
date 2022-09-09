<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    /* Rotas liberadas para gerentes */
    Route::group(['middleware' => ['test:manager']], function() {

        /* Gerenciar produtos */
        Route::group([], function() {

        });

    });

    /* Rotas liberadas para funcionários ou gerentes */
    Route::group(['middleware' => ['test:employee,manager']], function() {
    });

});

/* Rotas para gerenciar clientes */
// Route::group([], function() { //Clientes|sudo apt-get remove code


Route::group(['middleware' => ['auth', 'employee']], function () {

    Route::get('/customers', 'CustomerController@index');
    Route::get('/customers/{id}/show', 'CustomerController@show');
    Route::get('/customers/create',  'CustomerController@create');
    Route::post('/customers', 'CustomerController@insert');
    Route::get('/customers/{id}/delete', 'CustomerController@delete');
});

    Route::get('/customers/{id}/edit', 'CustomerController@edit');
    Route::put('/customers', 'CustomerController@update');

// Route::group([], function(){ //Categorias
Route::group(['middleware' => ['auth', 'employee']], function () {

    Route::get('/categories/create', 'CategoryController@create');
    Route::post('/categories',       'CategoryController@insert');
    Route::get('/categories/{id}/edit',   'CategoryController@edit');
    Route::put('/categories',        'CategoryController@update');
    Route::get('/categories/{id}/delete', 'CategoryController@delete');
    Route::get('/categories/{id}/products', 'CategoryController@show');
});


Route::get('/categories', 'CategoryController@index');

// Route::group([ 'middleware' => [ 'auth']], function () {
// Route::group([], function(){ //User


// Route::group([], function() { //Funcionários

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/employees',            'EmployeeController@index');
    Route::get('/employees/create',      'EmployeeController@create');
    Route::get('/employees/{id}/delete', 'EmployeeController@delete');
    Route::get('/employees/{id}/show', 'EmployeeController@show');
});

    Route::post('/employees',       'EmployeeController@insert');
    Route::put('/employees',        'EmployeeController@update');

Route::group(['middleware' => ['auth', 'user']], function () {

    Route::get('/employees/{id}/edit',   'EmployeeController@edit');
    // Route::group([], function() { //Usuarios
});



// Route::group([], function(){ // Produtos
Route::group(['middleware' => ['auth', 'employee', 'customer']], function () {

    Route::get('/products/create',       'ProductController@create');
    Route::post('/products',        'ProductController@insert');
    Route::get('/products/{id}/edit',    'ProductController@edit');
    Route::put('/products',         'ProductController@update');
    Route::get('/products/{id}/delete',  'ProductController@delete');

});
Route::group(['middleware' => ['auth', 'customer']], function () {

    Route::get('/products',             'ProductController@index');


    // Route::group([], function(){ //Estoque


    Route::get('/inventories',          'InventoryController@index');
    Route::get('/inventories/create',     'InventoryController@create');
    Route::post('/inventories',      'InventoryController@insert');
    Route::get('/inventories/{id}/delete',     'InventoryController@delete');

    // });

    // Route::group([], function(){ //Promoções

    Route::get('/promotions',           'PromotionController@index');
    Route::get('/promotions/create',     'PromotionController@create');
    Route::post('/promotions',      'PromotionController@insert');
    Route::get('/promotions/{id}/edit',  'PromotionController@edit');
    Route::put('/promotions',       'PromotionController@update');
    Route::get('/promotions/{id}/delete', 'PromotionController@delete');

    // });

    // Route::group([], function(){ //Vendas

    Route::get('/sales',                'SaleController@index');
    Route::get('sales/create',             'SaleController@create');
    Route::post('sales',           'SaleController@insert');
    Route::get('/sales/{id}/delete/',     'SaleController@delete');
    Route::get('/sales/{id}/products',   'SaleController@show');

    });
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/admins',            'AdminController@index');
    Route::get('/admins/create',      'AdminController@create');
    Route::post('/admins',       'AdminController@insert');
    Route::get('/admins/{id}/edit',   'AdminController@edit');
    Route::put('/admins',        'AdminController@update');
    Route::get('/admins/{id}/delete', 'AdminController@delete');
    Route::get('/admins/{id}/show', 'AdminController@show');

});
// Route::group([], function(){ //Carrinho

    Route::get('/cart', 'ProductController@indexCart');
// Route::get('/login',                'LoginController@showLoginForm');
// Route::post('/login',                'LoginController@login');
// Route::post('/login',                'LoginController@login');



Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // |        | GET|HEAD | login                    | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web                                         |
    // |        |          |                          |                  |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |
    // |        | POST     | login                    |                  | App\Http\Controllers\Auth\LoginController@login                        | web                                         |
    // |        |          |                          |                  |                                                                        | App\Http\Middleware\RedirectIfAuthenticated |
    // |        | POST     | logout                   | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web                                         |
    // |        | POST     | password/confirm         |                  | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web                                         |
    // |        |          |                          |                  |                                                                        | App\Http\Middleware\Authenticate            |
    // |        | GET|HEAD | password/confirm         | password.confirm | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web                                         |
    // |        |          |                          |                  |                                                                        | App\Http\Middleware\Authenticate            |
// |        | POST     | password/email           | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web                                         |
// |        | POST     | password/reset           | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web                                         |
// |        | GET|HEAD | password/reset           | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web                                         |
// |        | GET|HEAD | password/reset/{token}   | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web                                         |
