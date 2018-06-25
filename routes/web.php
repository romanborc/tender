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
	Route::post('/procurements', "Dashboard\ProcurementsController@store");
	Route::delete('/procurements/{id}', [
		'as' => 'delete_procurement',
		'uses' => 'Dashboard\ProcurementsController@destroy'
	]);
	Route::post('/search', 'Dashboard\SearchController@filter');
	Route::get('/search/participants', 'Dashboard\SearchController@searchParticipants');
	Route::get('/results', "Dashboard\ResultsController@get");

	Route::get('/users', "Dashboard\UsersController@index");
	Route::get('/calendar', "Dashboard\CalendarController@index");


	/* --================ API =============-- */
	Route::get('/procurements/{id}', "Dashboard\ResultsController@show");
	Route::post('/results', "Dashboard\ResultsController@updateOrCreate");
	Route::get('/edit/{id}', "Dashboard\ProcurementsController@edit");
	Route::post('/procurement', "Dashboard\ProcurementsController@update");
	Route::get('/getevents', "Dashboard\CalendarController@getEvents");
});



Route::group(['prefix' => 'manager', 'middleware' => 'manager'], function() {
	Route::get('/', "Base\BaseController@index");	
});





