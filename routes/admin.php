<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth'], function(){
    Route::get('login', 'LoginController@loginForm')->name('admin.login.form');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

Route::group(['middleware' => 'admin'], function(){
    Route::get('/', 'Dashboard\DashboardController@index')->name('admin.home');

    Route::group(['prefix'=> 'configurator', 'namespace' => 'Configurator'], function() {
    	Route::get('/scinterface', 'ScInterfaceController@index')->name('scinterface.home');
    	Route::post('/scinterface/create', 'ScInterfaceController@store')->name('scinterface.create');
    	Route::post('/scinterface/remove', 'ScInterfaceController@destroy')->name('scinterface.remove');
    });

    Route::resource('parameter','GeneralParameterController');

});