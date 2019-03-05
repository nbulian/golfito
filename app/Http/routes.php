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

Route::get('/', 'GolfController@showLogin')->middleware('web');

Route::get('logout', [ 
    'uses' => 'GolfController@getLogout',
    'as' => 'logout',
    'middleware' => 'auth'
]);

Route::get('login', [ 
    'uses' => 'GolfController@showLogin',
    'as' => 'show-login',
    'middleware' => 'guest'
]);

Route::post('authenticate', [ 
    'uses' => 'GolfController@authenticate',
    'as' => 'authenticate',
    'middleware' => 'guest'
]);

Route::get('dashboard', [ 
    'uses' => 'GolfController@dashboard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

Route::get('create-step1', [ 
    'uses' => 'GolfController@createStep1',
    'as' => 'create-step1',
    'middleware' => 'auth'
]);

Route::get('create-step2', [ 
    'uses' => 'GolfController@createStep2',
    'as' => 'create-step2',
    'middleware' => 'auth'
]);

Route::post('save-step1', [ 
    'uses' => 'GolfController@saveStep1',
    'as' => 'save-step1',
    'middleware' => 'auth'
]);

Route::post('save-step2', [ 
    'uses' => 'GolfController@saveStep2',
    'as' => 'save-step2',
    'middleware' => 'auth'
]);

Route::get('success/{id_tournaments}', [ 
    'uses' => 'GolfController@success',
    'as' => 'success',
    'middleware' => 'auth'
]);

Route::get('h2h-step1', [ 
    'uses' => 'GolfController@h2hStep1',
    'as' => 'h2h-step1',
    'middleware' => 'auth'
]);

Route::post('h2h-step2', [ 
    'uses' => 'GolfController@h2hStep2',
    'as' => 'h2h-step2',
    'middleware' => 'auth'
]);

Route::get('/players', [ 
    'uses' => 'GolfController@players',
    'as' => 'players',
    'middleware' => 'auth'
]);

Route::get('/new-player', [ 
    'uses' => 'GolfController@newPlayer',
    'as' => 'new-player',
    'middleware' => 'auth'
]);

Route::post('create-player', [ 
    'uses' => 'GolfController@createPlayer',
    'as' => 'create-player',
    'middleware' => 'auth'
]);

Route::get('/test', [ 
    'uses' => 'GolfController@test',
    'as' => 'test',
    'middleware' => 'guest'
]);