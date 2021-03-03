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
        Route::post('/technical/position','TechnicalMaturityController@updatePosition')->name('technical.position');
        Route::resource('/pricelist','PriceListController');
        Route::resource('/orbittype','OrbitTypeController');
    });

    Route::resource('customer','Customers\CustomerController');
    Route::post('customer/search','Customers\CustomerController@search')->name('customer_search');
    Route::get('reset_search','Customers\CustomerController@resetSearch')->name('reset_search');
    Route::resource('parameter','GeneralParameterController');
    Route::get('download/{name}','GeneralParameterController@downloadPdf')->name('download');
    
    Route::group(['prefix' => 'site-internet','namespace' => 'SiteInternet'],function(){
        Route::resource('text','TextController');
        Route::resource('/faq','FaqController');
        Route::post('/faq/position', 'FaqController@updatePosition')->name('faq.position');
    });


});