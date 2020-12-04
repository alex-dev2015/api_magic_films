<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/films'                     , 'filmsController@index');
Route::get('/filmsForDirector/{id}'     , 'filmsController@filmsForDirector');
Route::get('/filmByActors/{id}'         , 'filmsController@searchFilm');
Route::post('/films'                    , 'filmsController@create');

Route::get('/classifications', 'classificationsController@index');
Route::post('/classifications', 'classificationsController@create');

Route::get('/actors', 'actorsController@index');
Route::post('/actors', 'actorsController@create');

Route::get('/directors', 'directorsController@index');
Route::post('/directors', 'directorsController@create');
