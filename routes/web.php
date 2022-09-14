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
Route::group(['middleware' => ['auth']], function () {

    /*Rotas liberadas para funcionarios e gerentes */
    Route::get('/customers', 'CustomerController@index');
    Route::get('/customers/{id}/show', 'CustomerController@show');
    Route::get('/customers/create',  'CustomerController@create');
    Route::post('/customers', 'CustomerController@insert');
    Route::get('/customers/{id}/delete', 'CustomerController@delete');

});

/* Rotas para editar um cliente onde quando se cria a conta se redireciona para essas rotas*/
Route::group([], function(){  

    /* Rotas liberadas para funcionários, gerentes e clientes */
    Route::get('/customers/{id}/edit', 'CustomerController@edit');
    Route::put('/customers', 'CustomerController@update');

});

/*Rotas para gerenciar categorias */
Route::group(['middleware' => ['auth']], function () {

    /* Rotas liberadas para funcionários e gerentes */
    Route::get('/categories/create', 'CategoryController@create');
    Route::post('/categories',       'CategoryController@insert');
    Route::get('/categories/{id}/edit',   'CategoryController@edit');
    Route::put('/categories',        'CategoryController@update');
    Route::get('/categories/{id}/delete', 'CategoryController@delete');
    Route::get('/categories/{id}/products', 'CategoryController@show');
});
//
Route::group([], function(){

    Route::get('/categories', 'CategoryController@index');

});

/*Rotas para gerenciar funcionarios */
Route::group(['middleware' => ['auth']], function () {

    Route::get('/employees',            'EmployeeController@index');
    Route::get('/employees/create',      'EmployeeController@create');
    Route::get('/employees/{id}/delete', 'EmployeeController@delete');
    Route::get('/employees/{id}/show', 'EmployeeController@show');
});

    Route::post('/employees',       'EmployeeController@insert');
    Route::put('/employees',        'EmployeeController@update');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/employees/{id}/edit',   'EmployeeController@edit');
});



// Route::group([], function(){ // Produtos
Route::group(['middleware' => ['auth', 'employee']], function () {

    Route::get('/products/create',       'ProductController@create');
    Route::post('/products',        'ProductController@insert');
    Route::get('/products/{id}/edit',    'ProductController@edit');
    Route::put('/products',         'ProductController@update');
    Route::get('/products/{id}/delete',  'ProductController@delete');

});
Route::group(['middleware' => ['auth']], function () {

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

Route::group(['middleware' => ['auth']], function () {

    Route::get('/managers',            'ManagerController@index');
    Route::get('/managers/create',      'ManagerController@create');
    Route::post('/managers',       'ManagerController@insert');
    Route::get('/managers/{id}/edit',   'ManagerController@edit');
    Route::put('/managers',        'ManagerController@update');
    Route::get('/managers/{id}/delete', 'ManagerController@delete');
    Route::get('/managers/{id}/show', 'ManagerController@show');

});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/roles',            'EmployeeRoleController@index');
    Route::get('/roles/create', 'EmployeeRoleController@create');
    Route::post('/roles',       'EmployeeRoleController@insert');
    Route::get('/roles/{id}/edit',   'EmployeeRoleController@edit');
    Route::put('/roles',        'EmployeeRoleController@update');
    Route::get('/roles/{id}/delete', 'EmployeeRoleController@delete');
    Route::get('/roles/{id}/products', 'EmployeeRoleController@show');

});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/people',            'PersonController@index');
    Route::get('/people/create', 'PersonController@create');
    Route::post('/people',       'PersonController@insert');
    Route::get('/people/{id}/edit',   'PersonController@edit');
    Route::put('/people',        'PersonController@update');
    Route::get('/people/{id}/delete', 'PersonController@delete');
    Route::get('/people/{id}/products', 'PersonController@show');

});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', 'UserController@index');
    Route::get('/users/create', 'UserController@create');
    Route::post('/users',       'UserController@insert');
    Route::get('/users/{id}/edit', 'UserController@edit');
    Route::put('/users', 'UserController@update');
    Route::get('/users/{id}/delete', 'UserController@delete');

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
