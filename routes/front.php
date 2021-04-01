<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@stepOne')->name('step_one');
Route::get('/step_2','HomeController@stepTwo')->name('step_two');
Route::get('parameter/{orbite_id}','HomeController@orbiteParameter')->name('parameter');
Route::get('/step_3','HomeController@stepThree')->name('step_three');
Route::get('/step_4_cubsat','HomeController@stepCubesat')->name('step_cubesat');
Route::get('/step_4_smallsat','HomeController@stepSmallsat')->name('step_smallsat');
Route::get('/step_5/{type}','HomeController@stepFive')->name('step_five');
Route::get('/step_7','HomeController@stepSeven')->name('step_seven');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');