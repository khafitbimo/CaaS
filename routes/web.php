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


    


Auth::routes();
Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('index');

    Route::group(['prefix' => 'user'], function(){
        Route::get('/','UserController@index')->name('users');
        Route::post('/add','UserController@store');
        Route::post('/update','UserController@update');
        Route::post('/delete','UserController@delete');
    });

    Route::group(['prefix' => 'itemstatus'], function(){
        Route::get('/','ItemStatusController@index')->name('itemstatus');
        Route::post('/add','ItemStatusController@store');
        Route::post('/update','ItemStatusController@update');
        Route::post('/delete','ItemStatusController@delete');
    });

    Route::group(['prefix' => 'complianceitem'], function(){
        Route::get('/','ComplianceItemController@index')->name('complianceitem');
        Route::post('/add','ComplianceItemController@store');
        Route::post('/update','ComplianceItemController@update');
        Route::post('/delete','ComplianceItemController@delete');
        Route::get('/getitemjson/{item_group_id}','ComplianceItemController@getItemGroupByItemGroupId');
    });

    Route::group(['prefix' => 'complianceitemgroup'], function(){
        Route::get('/','ComplianceItemGroupController@index')->name('complianceitemgroup');
        Route::post('/add','ComplianceItemGroupController@store');
        Route::post('/update','ComplianceItemGroupController@update');
        Route::post('/delete','ComplianceItemGroupController@delete');
        Route::get('/getitemjson/{packages_id}','ComplianceItemGroupController@getItemGroupByPackageId');
    });

    Route::group(['prefix' => 'compliancepackage'], function(){
        Route::get('/','CompliancePackageController@index')->name('compliancepackage');
        Route::post('/add','CompliancePackageController@store');
        Route::post('/update','CompliancePackageController@update');
        Route::post('/delete','CompliancePackageController@delete');
        Route::get('/getJson','CompliancePackageController@getPackageJson');
    });

    Route::group(['prefix' => 'account'], function(){
        Route::get('/','AccountController@index')->name('account');
        Route::get('/profile','AccountController@index')->name('profile');
        Route::post('/add','AccountController@store');
        Route::post('/update','AccountController@update');
        Route::post('/delete','AccountController@delete');
        Route::get('/{id}','AccountController@getAccountById');
    });

    Route::group(['prefix' => 'accountpackage'], function(){
        Route::get('/','AccountPackageController@index')->name('accountpackage');
        Route::post('/add','AccountPackageController@store');
        Route::post('/update','AccountPackageController@update');
        Route::post('/delete','AccountPackageController@delete');
        Route::get('/updatestatus/{id}/{statusid}','AccountPackageController@updatestatus');
    });

    Route::group(['prefix' => 'accountitemgroup'], function(){
        Route::get('/','AccountItemGroupController@index')->name('accountitemgroup');
        Route::post('/add','AccountItemGroupController@store');
        Route::post('/update','AccountItemGroupController@update');
        Route::post('/delete','AccountItemGroupController@delete');
        Route::get('/getitemjson/{packages_id}','AccountItemGroupController@getItemGroupByPackageId');
    });

    Route::group(['prefix' => 'accountitem'], function(){
        Route::get('/','AccountItemController@index')->name('accountitem');
        Route::post('/add','AccountItemController@store');
        Route::post('/update','AccountItemController@update');
        Route::post('/delete','AccountItemController@delete');
        Route::get('/getitemjson/{item_group_id}','AccountItemController@getItemGroupByItemGroupId');
    });
});
