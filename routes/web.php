<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

/* Rotas para gerenciar clientes */
Route::group([], function() { //Clientes

    Route::get  ('/customers', 'CustomerController@index');
    Route::get  ('/customers/{id}/show', 'CustomerController@show');
    Route::get  ('/customers/create',  'CustomerController@create');
    Route::get  ('/customers/{id}/edit', 'CustomerController@edit');
    Route::post ('/customers', 'CustomerController@insert');
    Route::put  ('/customers', 'CustomerController@update');
    Route::get  ('/customer/{id}/delete', 'CustomerController@delete');

});

Route::group([], function(){ //Categorias

    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/create', 'CategoryController@create');
    Route::post('/categories',       'CategoryController@insert');
    Route::get('/categories/{id}/edit',   'CategoryController@edit');
    Route::put('/categories',        'CategoryController@update');
    Route::get('/categories/{id}/delete', 'CategoryController@delete');
    Route::get('/categories/{id}/products', 'CategoryController@show');
});

Route::group([], function() { //Funcionários

    Route::get('/employees',            'EmployeeController@index');
    Route::get('/employees/create',      'EmployeeController@create');
    Route::post('/employees',       'EmployeeController@insert');
    Route::get('/employees/{id}/edit',   'EmployeeController@edit');
    Route::put('/employees',        'EmployeeController@update');
    Route::get('/employees/{id}/delete', 'EmployeeController@delete');
    Route::get('/employees/{id}/show', 'EmployeeController@show');

});

Route::group([], function(){ // Produtos

    Route::get('/products',             'ProductController@index');
    Route::get('/products/create',       'ProductController@create');
    Route::post('/products',        'ProductController@insert');
    Route::get('/products/{id}/edit',    'ProductController@edit');
    Route::put('/products',         'ProductController@update');
    Route::get('/products/{id}/delete',  'ProductController@delete');

});

Route::group([], function(){ //Estoque

    Route::get('/inventories',          'InventoryController@index');
    Route::get('/inventories/create',     'InventoryController@create');
    Route::post('/inventories',      'InventoryController@insert');
    Route::get('/inventories/{id}/delete',     'InventoryController@delete');

});

Route::group([], function(){ //Promoções

    Route::get('/promotions',           'PromotionController@index');
    Route::get('/promotions/create',     'PromotionController@create');
    Route::post('/promotions',      'PromotionController@insert');
    Route::get('/promotions/{id}/edit',  'PromotionController@edit');
    Route::put('/promotions',       'PromotionController@update');
    Route::get('/promotions/{id}/delete', 'PromotionController@delete');

});

Route::group([], function(){ //Vendas

    Route::get('/sales',                'SaleController@index');
    Route::get('sales/create',             'SaleController@create');
    Route::post('sales',           'SaleController@insert');
    Route::get('/sales/{id}/delete/',     'SaleController@delete');
    Route::get('/sales/{id}/products',   'SaleController@show');

});
