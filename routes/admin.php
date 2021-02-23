<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Auth'], function(){
    Route::get('login', 'LoginController@loginForm')->name('admin.login.form');
    Route::post('login', 'LoginController@login')->name('admin.login');
});

Route::group(['middleware' => 'admin'], function(){
    Route::get('/', 'Dashboard\DashboardController@index')->name('admin.home');
});