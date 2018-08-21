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

Route::get('/', function () {
    return view('welcome');
});

/*
* Dashboard routes
*/
Route::prefix('dashboard')->group(function () {

    /*
    * Dashboard landing page
    */
    Route::get('/', function () {
        return view('dashboard');
    });

    /*




    /*
    * Get access token
    */
    Route::get('spotify/get-access-token', 'MusicController@getAccessToken');
    
    /*
    * Get current song
    */
    Route::get('spotify/current-song', 'MusicController@getCurrentSong');

    /*
    * Auth user
    */
    Route::get('spotify/auth', 'MusicController@authUser');
   
   
});
