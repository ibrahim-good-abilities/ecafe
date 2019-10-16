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


Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', function(){

            if(auth()->user()){
                if (auth()->user()->role->role_name == 'admin') {
                    return redirect()->route('orders');
                }elseif (auth()->user()->role->role_name == 'captain') {
                    return redirect()->route('captain');
                }elseif (auth()->user()->role->role_name == 'cashier') {
                    return redirect()->route('cashier');
                }elseif (auth()->user()->role->role_name == 'customer') {
                    return redirect()->route('welcome');
                }elseif (auth()->user()->role->role_name == 'parista') {
                    return redirect()->route('parista');
                }else{
                    return redirect('/login');
                }
            }else{
                return redirect('/login');
            }

})->name('home');



//Route::get('/register','RegisterController@store')->name('sign_up');

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    //admins pages
    //role
    Route::get('/role/create','RoleController@create')->name('add_role');
    Route::post('/role/store','RoleController@store')->name('store_role');
    Route::get('/role/index','RoleController@index')->name('all_roles');
    Route::get('/role/edit/{id}','RoleController@edit')->name('edit_role');
    Route::post('/role/update/{id}','RoleController@update')->name('update_role');
    Route::get('/role/delete/{id}','RoleController@destroy')->name('delete_role');
    //user
    Route::get('/users','RegisterController@index')->name('all_users');
    Route::get('/users/delete/{id}','RegisterController@destroy')->name('delete_user');
    Route::get('/users/create','RegisterController@create')->name('add_user');
    Route::post('/users/store','RegisterController@store')->name('store_user');
    Route::get('/users/edit/{id}','RegisterController@edit')->name('edit_user');
    Route::post('/users/update/{id}','RegisterController@update')->name('update_user');




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
    
    
    Route::get('/orders/delete/{id}','OrderController@destroy')->name('delete_order');
    Route::get('/orders/edit/{id}/{notification_id?}','OrderController@edit')->name('edit_order');
    //stock
    Route::get('/stock/index','ItemController@stock')->name('stock');
    Route::post('/stock/main/transfer','ItemController@transferMainStock')->name('transfer_main_stock');
    Route::post('/stock/main/operations','ItemController@mainStockOperations')->name('main_stock_operations');

    Route::post('/stock/available/transfer','ItemController@transferAvailableStock')->name('transfer_available_stock');
    Route::post('/stock/available/operations','ItemController@availableStockOperations')->name('available_stock_operations');

    //menu items
    Route::get('/menu/index','ItemController@menu')->name('menu');
    Route::get('/menu/create','ItemController@createMenuItem')->name('add_menu_item');
    Route::post('/menu/store','ItemController@storeMenuItem')->name('store_menu_item');
    Route::get('/menu/edit/{id}', 'ItemController@menuEdit')->name('menu_edit');
    Route::post('/menu/edit/{id}', 'ItemController@menuUpdate')->name('menu_item_update');

    //coupons
    Route::get('/coupons/index','CouponController@index')->name('coupons');
    Route::get('/coupons/edit/{id}','CouponController@edit')->name('coupon_edit');
    Route::post('/coupons/update/{id}','CouponController@update')->name('update_coupon');
    Route::get('/coupons/delete/{id}','CouponController@destroy')->name('coupon_delete');
    Route::get('/coupons/add-new','CouponController@create')->name('add_coupon');
    Route::post('/coupons/add-new','CouponController@store')->name('store_coupon');
    //customer
    //parista
    //Packing Units
    Route::get('/packing-units/delete/{id}','PackingUnitController@destroy')->name('packing_unit_delete');
    Route::resource('packing-units', 'PackingUnitController');
    //ingredients
    Route::resource('ingredients', 'IngrediantController');
    Route::get('/ingredient/delete/{id}','IngrediantController@destroy')->name('ingredient_delete');

    //cashier

    //settings
    Route::get('/settings','SettingController@settings')->name('settings');
    Route::post('/setting/store','SettingController@store')->name('store_setting');
});
Route::group(['middleware' => 'App\Http\Middleware\ParistaMiddleware'], function()
{
    //parista pages
    Route::get('/parista/{notification_id?}','OrderController@parista')->name('parista');

});
Route::group(['middleware' => 'App\Http\Middleware\CaptainMiddleware'], function()
{
    Route::get('/captain','IndexController@captain')->name('captain');
    Route::get('/captain/order/{id}','IndexController@captainOrder')->name('captain-order');
    Route::get('/captain/order/{id}/edit','IndexController@captainEditOrder')->name('captain-edit-order');
});
Route::group(['middleware' => 'App\Http\Middleware\CustomerMiddleware'], function()
{
    //customer pages
    Route::get('/welcome','IndexController@welcome')->name('welcome');

});
Route::group(['middleware' => 'App\Http\Middleware\CashierMiddleware'], function()
{
    //cashier pages
    Route::get('/cashier','IndexController@cashier')->name('cashier');
    Route::post('/cashier/order','OrderController@orderPaid');
});


Route::post('/order/send-new-notification','OrderController@sendNewNotification');
Route::post('/orders/add-new','OrderController@create');
Route::post('/orders/{id}','OrderController@update');
Route::post('/orders/update/status/{id}', 'OrderController@updateStatus')->name('order_update_status');
Route::get('/orders/edit/status/{id}', 'OrderController@editStatus')->name('order_edit_status');
//updateOrderLineStatus
Route::post('/orderline/update/status/{id}','OrderController@updateOrderLineStatus')->name('order_line_update_status');


