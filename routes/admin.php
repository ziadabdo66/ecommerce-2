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
            Route::get('/}', 'MainCategoriesController@index')->name('admin.mainCategories');
            Route::get('/create', 'MainCategoriesController@create')->name('admin.mainCategories.create');
            Route::post('/store', 'MainCategoriesController@store')->name('admin.mainCategories.store');
            Route::get('/edit/{id}', 'MainCategoriesController@edit')->name('admin.mainCategories.edit');
            Route::post('/update/{id}', 'MainCategoriesController@update')->name('admin.mainCategories.update');
            Route::get('/delete/{id}', 'MainCategoriesController@delete')->name('admin.mainCategories.delete');



        });
        #####################end categories##############
        #####################brands##################
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', 'BrandController@index')->name('admin.brand');
            Route::get('/create', 'BrandController@create')->name('admin.brand.create');
            Route::post('/store', 'BrandController@store')->name('admin.brand.store');
            Route::get('/edit/{id}', 'BrandController@edit')->name('admin.brand.edit');
            Route::post('/update/{id}', 'BrandController@update')->name('admin.brand.update');
            Route::get('/delete/{id}', 'BrandController@delete')->name('admin.brand.delete');



        });
        #######################endbrands#####################
        ######################Tags###########################
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'TagController@index')->name('admin.tag');
            Route::get('/create', 'TagController@create')->name('admin.tag.create');
            Route::post('/store', 'TagController@store')->name('admin.tag.store');
            Route::get('/edit/{id}', 'TagController@edit')->name('admin.tag.edit');
            Route::post('/update/{id}', 'TagController@update')->name('admin.tag.update');
            Route::get('/delete/{id}', 'TagController@delete')->name('admin.tag.delete');



        });
        ##############################end tags###################
        ##############################Products###################
        Route::group(['prefix'=>'products'],function (){
            Route::get('/', 'ProducController@index')->name('admin.product');
            Route::get('/create', 'producController@create')->name('admin.product.create');
            Route::post('/store', 'ProducController@store')->name('admin.product.store');
            Route::get('/price/{id}', 'ProducController@price')->name('admin.product.price');
            Route::post('/storePrice', 'ProducController@storePrice')->name('admin.product.storePrice');
            Route::get('/stock/{id}', 'ProducController@stock')->name('admin.product.stock');
            Route::post('/storeStock', 'ProducController@storeStock')->name('admin.product.storeStock');
            Route::get('/images/{id}', 'ProducController@images')->name('admin.product.images');
            Route::post('/storeImages', 'ProducController@storeimages')->name('admin.product.storeImages');
            Route::post('/storeImages_DB', 'ProducController@storeimages_DB')->name('admin.product.storeImages_DB');
            Route::get('/DeleteImages/{image_id}', 'ProducController@Deleteimages')->name('admin.product.DeleteImages');

        });
        ##############################end products###################
        ##############################attributes#####################
        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', 'attributeController@index')->name('admin.attribute');
            Route::get('/create', 'attributeController@create')->name('admin.attribute.create');
            Route::post('/store', 'attributeController@store')->name('admin.attribute.store');
            Route::get('/delete/{id}', 'attributeController@delete')->name('admin.brand.delete');
            Route::get('/edit/{id}', 'attributeController@edit')->name('admin.attribute.edit');
            Route::post('/update/{id}', 'attributeController@update')->name('admin.attribute.update');
        });
            ##############################end attributes###################
            ##############################options#####################
            Route::group(['prefix' => 'options'], function () {
                Route::get('/', 'OptionController@index')->name('admin.option');
                Route::get('/create', 'OptionController@create')->name('admin.option.create');
                Route::post('/store', 'OptionController@store')->name('admin.option.store');
                Route::get('/edit/{id}', 'OptionController@edit')->name('admin.option.edit');
                Route::post('/update/{id}', 'OptionController@update')->name('admin.option.update');
                Route::get('/delete/{id}', 'OptionController@delete')->name('admin.option.delete');





        });

    });

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin','prefix'=>'admin'], function () {
        Route::get('login', 'LoginController@login')->name('login.admin');
        Route::post('postuser', 'LoginController@postlogin')->name('admin.login');;

    });
});



