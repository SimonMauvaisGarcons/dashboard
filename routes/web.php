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
    * Twitch
    */
    Route::get('twitch', 'TwitchController@index');




});


/**
 * User profile route
 */
Auth::routes();
Route::group(['middleware' => ['auth']], function () {

    Route::get('/profile', 'HomeController@index')->name('profile');

    /*
    * Dashboard
    */
    Route::get('/dashboard', function () { return view('dashboard'); });

    /*
    * Spotify route
    */
    Route::get('spotify/current-song', 'MusicController@getCurrentSong');
    Route::get('spotify/auth', 'MusicController@index');
    Route::get('spotify/auth/go', ['as' => 'spotify.auth.go', 'uses' => "MusicController@authUser"] );
    Route::get('spotify/refresh', 'MusicController@refreshToken');

    /**
     * Upadte twitch user
     */
    Route::get('twitch/update', 'TwitchController@updateUser');


     /**
     * Add event
     */
    Route::post('evenement/add', 'EventController@add');
    Route::get('evenement/delete', 'EventController@delete');

});


