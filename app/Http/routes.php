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