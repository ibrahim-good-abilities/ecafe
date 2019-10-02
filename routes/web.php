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


use Illuminate\Routing\Router;

Route::get('/', 'IndexController@index')->name('home');
Route::get('/inventory-sheet', 'InventoryController@index')->name('inventory-sheet');
//categories
Route::get('/categories/index','CategoryController@index')->name('all_categories');
Route::get('/categories/create','CategoryController@create')->name('add_category');
Route::get('/categories/delete/{id}','CategoryController@destroy')->name('delete_category');
Route::get('/categories/edit/{id}','CategoryController@edit')->name('edit_category');
Route::post('/categories/update/{id}','CategoryController@update')->name('category_update');
Route::post('/categories/store', 'CategoryController@store')->name('store');
//items
Route::get('/items/create','ItemController@create')->name('add_item');
Route::post('/items/add','ItemController@store');
Route::get('/items/index', 'ItemController@index')->name('items_index');
Route::get('/items/edit/{name}/{id}', 'ItemController@edit')->name('item_edit');
Route::post('/items/edit/{id}', 'ItemController@update')->name('item_update');
Route::get('/items/delete/{id}','ItemController@destroy')->name('item_delete');
//orders
Route::get('/orders/index','OrderController@index')->name('orders');
Route::post('/orders/add-new','OrderController@create');
Route::get('/orders/edit/{id}','OrderController@edit')->name('edit_order');
Route::get('/orders/delete/{id}','OrderController@destroy')->name('delete_order');
//stock
Route::get('/stock/index','ItemController@stock')->name('stock');
Route::post('/stock/main/transfer','ItemController@transferMainStock')->name('transfer_main_stock');
Route::post('/stock/main/operations','ItemController@mainStockOperations')->name('main_stock_operations');

Route::post('/stock/available/transfer','ItemController@transferAvailableStock')->name('transfer_available_stock');
Route::post('/stock/available/operations','ItemController@availableStockOperations')->name('available_stock_operations');

//coupons
Route::get('/coupons/index','CouponController@index')->name('coupons');
Route::get('/coupons/edit/{id}','CouponController@edit')->name('coupon_edit');
Route::get('/coupons/delete/{id}','CouponController@destroy')->name('coupon_delete');
Route::get('/coupons/add-new','CouponController@create')->name('add_coupon');
Route::post('/coupons/add-new','CouponController@store')->name('store_coupon');
//user
Route::get('/welcome','IndexController@welcome')->name('welcome');
//parista
Route::get('/parista','OrderController@parista')->name('parista');






