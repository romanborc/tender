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

Route::get('/', function () {
	return view('auth.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::get('/', "Dashboard\ProcurementsController@index");
	Route::get('procurements/create', "Dashboard\ProcurementsController@create");
	
	Route::delete('/procurements/{id}', 'Dashboard\ProcurementsController@deleteProcurements');
	Route::delete('/lots/{id}', 'Dashboard\ProcurementsController@deleteLot');
	Route::delete('/result/{id}', 'Dashboard\ResultsController@deleteLotResult');
	Route::delete('/results/{id}', 'Dashboard\ResultsController@deleteResult');

	Route::get('/search', 'Dashboard\SearchController@filter');
	Route::get('/filter', 'Dashboard\SearchController@filterStatistic');
	Route::get('/search/participants', 'Dashboard\SearchController@searchParticipants');
	Route::get('/results', "Dashboard\ResultsController@get");

	Route::get('/users', "Dashboard\UsersController@index");
	Route::get('/calendar', "Dashboard\CalendarController@index");
	Route::get('/statistic', 'Dashboard\StatisticController@index');


	/* --================ API =============-- */
	Route::get('/procurements/{id}', "Dashboard\ResultsController@show");
	Route::post('/results', "Dashboard\ResultsController@updateOrCreate");
	Route::get('/edit/{id}', "Dashboard\ProcurementsController@edit");
	Route::post('/procurements', "Dashboard\ProcurementsController@store");
	Route::post('/procurement', "Dashboard\ProcurementsController@update");
	Route::get('/getevents', "Dashboard\CalendarController@getEvents");
});



Route::group(['prefix' => 'manager', 'middleware' => 'manager'], function() {
	Route::get('/', "Base\BaseController@index");	
});





