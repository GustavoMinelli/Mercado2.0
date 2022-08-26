<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');});

/* Rotas para gerenciar clientes */
Route::group([], function() { //Clientes

    Route::get  ('/customers', 'CustomerController@index');
    Route::get  ('/customer/{id}/show', 'CustomerController@show');
    Route::get  ('/customer/create',  'CustomerController@create');
    Route::get  ('/customer/{id}/edit', 'CustomerController@edit');
    Route::post ('/customer', 'CustomerController@insert');
    Route::put  ('/customer', 'CustomerController@update');
    Route::get  ('/customer/{id}/delete', 'CustomerController@delete');

});

Route::group([], function(){ //Categorias

    Route::get('/categories', 'CategoryController@index');
    Route::get('/category/create', 'CategoryController@create');
    Route::post('/category',       'CategoryController@insert');
    Route::get('/category/{id}/edit',   'CategoryController@edit');
    Route::put('/category',        'CategoryController@update');
    Route::get('/category/{id}/delete', 'CategoryController@delete');
    Route::get('/category/{id}/products', 'CategoryController@show');
});

Route::group([], function() { //Funcionários

    Route::get('/employees',            'EmployeeController@index');
    Route::get('/employee/create',      'EmployeeController@create');
    Route::post('/employee',       'EmployeeController@insert');
    Route::get('/employee/{id}/edit',   'EmployeeController@edit');
    Route::put('employee',        'EmployeeController@update');
    Route::get('/employee/{id}/delete', 'EmployeeController@delete');
    Route::get('/employee/{id}/show', 'EmployeeController@show');

});

Route::group([], function(){ // Produtos

    Route::get('/products',             'ProductController@index');
    Route::get('/product/create',       'ProductController@create');
    Route::post('/product',        'ProductController@insert');
    Route::get('/product/{id}/edit',    'ProductController@edit');
    Route::put('/product',         'ProductController@update');
    Route::get('/product/{id}/delete',  'ProductController@delete');

});

Route::group([], function(){ //Estoque

    Route::get('/inventories',          'InventoryController@index');
    Route::get('/inventory/create',     'InventoryController@create');
    Route::post('/inventory',      'InventoryController@insert');
    Route::get('/inventory/{id}/delete',     'InventoryController@delete');

});

Route::group([], function(){ //Promoções

    Route::get('/promotions',           'PromotionController@index');
    Route::get('/promotion/create',     'PromotionController@create');
    Route::post('/promotion',      'PromotionController@insert');
    Route::get('/promotion/{id}/edit',  'PromotionController@edit');
    Route::put('/promotion',       'PromotionController@update');
    Route::get('/promotion/{id}/delete', 'PromotionController@delete');

});

Route::group([], function(){ //Vendas

    Route::get('/sales',                'SaleController@index');
    Route::get('sale/create',             'SaleController@create');
    Route::post('sale',           'SaleController@insert');
    Route::get('/sale/{id}/delete/',     'SaleController@delete');
    Route::get('/sale/{id}/products',   'SaleController@show');

});
