<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');


/*
 * API Routes
 */

/*---------- GET REQUESTS ------------*/
Route::get('/initialize','API\WelcomeAPIController@initializeWelcomeView');
Route::get('/user-data','API\WelcomeAPIController@userData');



/*---------- POSTS REQUESTS ----------*/
Route::post('/save-country','API\UserDataController@saveCountry');
Route::post('/personal-details','API\UserDataController@savePersonalDetails');
Route::post('/idea-team','API\UserDataController@saveIdeaTeam');
Route::post('/idea-details','API\UserDataController@saveIdeaDetails');
Route::post('/idea-additional-info','API\UserDataController@saveIdeaAdditionalDetails');