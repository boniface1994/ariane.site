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
        Route::post('/orbittype/removeparameter','OrbitTypeController@removeParameter')->name('orbittype.removeparameter');
        Route::post('/orbittype/position','OrbitTypeController@updatePosition')->name('orbittype.position');
        Route::resource('/satelliteposition','SatellitePositionController');
        Route::resource('/option','OptionController');
        Route::post('/option/position', 'OptionController@updatePosition')->name('option.position');
        Route::resource('/option-cost','OptionCostController');
        Route::resource('/option-cost-cubesat','CostCubesatController');
        Route::resource('/suppliertype', 'SupplierTypeController');
        Route::post('/suppliertype/position','SupplierTypeController@updatePosition')->name('suppliertype.position');
        Route::resource('/flightopportunity', 'FlightOpportunityController');
        Route::post('/flightopportunity/position','FlightOpportunityController@updatePosition')->name('flightopportunity.position');
        Route::resource('/propellanttype', 'PropellantTypeController');
        Route::post('/propellanttype/position','PropellantTypeController@updatePosition')->name('propellanttype.position');
    });

    Route::resource('customer','Customers\CustomerController');
    Route::post('customer/search','Customers\CustomerController@search')->name('customer_search');
    Route::get('customer/reset-search','Customers\CustomerController@resetSearch')->name('reset_search');
     
    Route::resource('project','Project\ProjectController'); 
    Route::post('project/search','Project\ProjectController@projectSearch')->name('project_search');
    Route::get('project/reset-search','Project\ProjectController@resetSearch')->name('reset_project');
    Route::get('project/document/{project_id}','Project\DocumentController@index')->name('document');
    Route::post('project/document/add','Project\DocumentController@store')->name('document_create');
    Route::get('project/document/delete/{document_id}','Project\DocumentController@destroy')->name('document.destroy');

    Route::resource('parameter','GeneralParameterController');
    Route::get('download/{name}','GeneralParameterController@downloadPdf')->name('download');
    Route::resource('request','ContactRequestController');
    Route::post('request/search','ContactRequestController@search')->name('request_search');
    Route::get('request_reset_search','ContactRequestController@resetSearch')->name('request_reset_search');
    
    Route::group(['prefix' => 'site-internet','namespace' => 'SiteInternet'],function(){
        Route::resource('text','TextController');
        Route::get('text_reset_search','TextController@resetSearch')->name('text_reset_search');
        Route::post('text/search','TextController@search')->name('text_search');
        Route::resource('/faq','FaqController');
        Route::post('/faq/position', 'FaqController@updatePosition')->name('faq.position');
    });


});