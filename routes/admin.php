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
Route::get('/admin', function () {
    return view('layouts.admin');
});
Route::group(['middleware'=>'auth:admin','namespace'=>'Dashboard'],function () {
    Route::get('/', 'adminDashboard@index')->name('admin_dashboard');
});

    Route::group(['namespace'=>'Dashboard','middleware'=>'guest:admin'],function (){
        Route::get('user','LoginController@login')->name('login.admin');
        Route::post('postuser','LoginController@postlogin')->name('admin.login');;

});


