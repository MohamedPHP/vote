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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/api/login', 'ApiController@login');
Route::post('/api/register', 'ApiController@register');
Route::post('/api/UsernameValidation', 'ApiController@UsernameValidation');
Route::post('/api/questions', 'ApiController@QuestionsGetAll');
Route::post('/api/questions/highesttrend', 'ApiController@highestTrend');
Route::post('/api/questions/previousvoting', 'ApiController@previousVoting');
Route::post('/api/questions/search', 'ApiController@search');
Route::post('/api/questions/vote', 'ApiController@vote');
Route::post('/api/questions/suggest', 'ApiController@suggestAvote');
Route::post('/api/countries', 'ApiController@CountriesGetAll');
