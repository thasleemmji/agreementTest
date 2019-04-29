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
//login or common routes
Route::group(['middleware' => 'guest'], function () {
	Route::get('/', 'LoginController@index');
	Route::post('login', 'LoginController@authenticate')->name('login');
});
//autherized routes
Route::group(['middleware' => 'autherized'], function () {
	Route::post('logout', 'LoginController@logout')->name('logout');
});
//only admin routes
Route::group(['middleware' => 'admin'], function () {
	Route::resource('agreements', 'AgreementController');
});
//only agents routes
Route::group(['middleware' => 'agent'], function () {
	Route::get('agent', 'AgentController@index');
	Route::post('agent/accept-agreement', 'AgentController@acceptAgreement');
});