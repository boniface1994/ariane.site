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
Route::group(['prefix'=>'c'],function(){
	Route::get('/', 'HomeController@stepOne')->name('step_one');
	Route::post('onetwo','HomeController@oneTwo')->name('session_one');
	Route::get('/step_2','HomeController@stepTwo')->name('step_two');
	Route::post('twothree','HomeController@twoThree')->name('session_two');
	Route::get('parameter/{orbite_id}','HomeController@orbiteParameter')->name('parameter');
	Route::get('/step_3','HomeController@stepThree')->name('step_three');
	Route::post('threefour','HomeController@threeFour')->name('session_three');
	Route::get('/step_4_cubsat','HomeController@stepCubesat')->name('step_cubesat');
	Route::post('cubesatfive','HomeController@cubesatFive')->name('session_cubesat');
	Route::get('/step_4_smallsat','HomeController@stepSmallsat')->name('step_smallsat');
	Route::post('smallsatfive','HomeController@smallsatFive')->name('session_smallsat');
	Route::get('/step_5/{type}','HomeController@stepFive')->name('step_five');
	Route::post('fivesix','HomeController@fiveSix')->name('session_five');
	Route::get('/step_7','HomeController@stepSeven')->name('step_seven');

	Route::get('dataquater','HomeController@getQuarter')->name('allquarter');

});

Route::get('/connect','HomeController@connectCompte')->name('connect');
Route::get('/signin','RegisterController@signin')->name('signin');
Route::get('/project-name','RegisterController@beforeLogin')->name('beforelogin');
Route::post('/before-login','RegisterController@toLogin')->name('toLogin');
Route::get('/front-login','LoginController@login')->name('login_front');

Route::get('/timeline','LoginController@timeline')->name('timeline');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');