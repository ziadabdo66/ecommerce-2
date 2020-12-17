<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
//prefix is admin in route service provider
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {


    Route::group(['middleware' => 'auth:admin', 'namespace' => 'Dashboard','prefix'=>'admin'], function () {
        Route::get('/', 'adminDashboard@index')->name('admin_dashboard');
        //for settingController
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods\{type}', 'SettingController@editShippingMethods')->name('shippingMethod');
            Route::put('shipping-methods\{id}', 'LoginController@updateShippingMethods')->name('updateShippingMethod');;

        });
    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin','prefix'=>'admin'], function () {
        Route::get('user', 'LoginController@login')->name('login.admin');
        Route::post('postuser', 'LoginController@postlogin')->name('admin.login');;

    });
});



