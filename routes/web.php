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
Route::get('/categories/index','CategoryController@index')->name('all_categories');
Route::get('/categories/create','CategoryController@create')->name('add_category');
Route::get('/categories/delete/{id}','CategoryController@destroy')->name('delete_category');
Route::get('/categories/edit/{id}','CategoryController@edit')->name('edit_category');
Route::post('/categories/update/{id}','CategoryController@update')->name('category_update');

Route::get('/items/create','ItemController@create')->name('add_item');
Route::post('/categories/store', 'CategoryController@store')->name('store');

Route::post('/items/add','ItemController@store');
Route::get('/items/index', 'ItemController@index')->name('items_index');
Route::get('items/edit/{id}', 'ItemController@edit')->name('item_edit');
Route::post('items/edit/{id}', 'ItemController@update')->name('item_update');
Route::get('items/delete/{id}','ItemController@destroy')->name('item_delete');
//orders
Route::get('orders/index','OrderController@index')->name('orders');
Route::get('orders/edit/{id}','OrderController@edit')->name('edit_order');
