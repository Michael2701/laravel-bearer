<?php

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


    Route::post('login', 'AuthApi@login');
    Route::post('subscribe', 'AuthApi@subscribe');

    Route::get('getMovies', 'MovieController@getMovies');
    Route::post('getMovies', 'MovieController@getMovies');
    Route::post('searchMovies', 'MovieController@searchMovies');
    Route::get('getGenres', 'GenreController@getGenres');

    Route::get('getAutocomplete', 'AutoComplete@autoComlete');

    Route::middleware(['authApi'])->group(function ()
    {
        Route::get('get-users', 'UserController@getAllUsers');
    });
