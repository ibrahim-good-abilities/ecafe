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

use Illuminate\Routing\Router;

Route::get('/', 'IndexController@index')->name('home');
Route::get('/inventory-sheet', 'InventoryController@index')->name('inventory-sheet');
Route::get('/categories/create','CategoryController@index')->name('add_category');
Route::get('/items/create','ItemController@create')->name('add_item');
Route::post('/categories/store', 'CategoryController@store')->name('store');
Route::post('/items/add','ItemController@store');
//
Route::get('/items/index', 'ItemController@index')->name('items_index');
Route::get('items/edit/{id}', 'ItemController@edit')->name('item_edit');
Route::post('items/edit/{id}', 'ItemController@update')->name('item_update');
