<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth'], function(){
    Route::get('login', 'LoginController@loginForm')->name('admin.login.form');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

Route::group(['middleware' => 'admin'], function(){
    Route::get('/', 'Dashboard\DashboardController@index')->name('admin.home');

    Route::group(['prefix'=> 'configurator', 'namespace' => 'Configurator'], function() {
    	Route::resource('/scinterface', 'ScInterfaceController');
    	Route::post('/scinterface/position', 'ScInterfaceController@updatePosition')->name('scinterface.position');
        Route::resource('/trimester','QuarterAvailableController');
        Route::resource('/technical','TechnicalMaturityController');
        Route::resource('/pricelist','PriceListController');
    });

    Route::resource('customer','Customers\CustomerController');
    Route::resource('parameter','GeneralParameterController');
    Route::get('download/{name}','GeneralParameterController@downloadPdf')->name('download');


});