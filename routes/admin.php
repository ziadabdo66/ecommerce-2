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
        Route::get('logout', 'LoginController@logout')->name('admin.logout');
        Route::get('AdminProfile', 'Adminprofile@edit')->name('edit.profile');
        Route::put('updateProfile/{id}', 'Adminprofile@update')->name('updateProfile');
        //for settingController
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods\{type}', 'SettingController@editShippingMethods')->name('shippingMethod');
            Route::put('shipping-methods\{id}', 'SettingController@updateShippingMethods')->name('updateShippingMethod');;

        });
        ##################Categoris###################
        Route::group(['prefix' => 'MainCategories'], function () {
            Route::get('/{type}', 'MainCategoriesController@index')->name('admin.mainCategories');
            Route::get('/create/{type}', 'MainCategoriesController@create')->name('admin.mainCategories.create');
            Route::post('/store', 'MainCategoriesController@store')->name('admin.mainCategories.store');
            Route::get('/edit/{id}', 'MainCategoriesController@edit')->name('admin.mainCategories.edit');
            Route::post('/update/{id}', 'MainCategoriesController@update')->name('admin.mainCategories.update');
            Route::get('/delete/{id}', 'MainCategoriesController@delete')->name('admin.mainCategories.delete');
            ####################edit and delete and update subcategory
            Route::get('/editSub/{id}', 'MainCategoriesController@editSub')->name('admin.subCategories.edit');
            Route::post('/updateSub/{id}', 'MainCategoriesController@updateSub')->name('admin.subCategories.update');
            Route::get('/deleteSub/{id}', 'MainCategoriesController@deleteSub')->name('admin.subCategories.delete');


        });
        #####################end categories##############
    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin','prefix'=>'admin'], function () {
        Route::get('login', 'LoginController@login')->name('login.admin');
        Route::post('postuser', 'LoginController@postlogin')->name('admin.login');;

    });
});



