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
    * Twitch
    */
    Route::get('twitch', 'TwitchController@index');
    /*
    * Get current song
    */
    Route::get('spotify/current-song', 'MusicController@getCurrentSong');

    /*
    * Auth user to spotify
    */
    Route::get('spotify/auth', 'MusicController@index');



    Route::get('spotify/auth/go', ['as' => 'spotify.auth.go', 'uses' => "MusicController@authUser"] );
    
   
   
});
