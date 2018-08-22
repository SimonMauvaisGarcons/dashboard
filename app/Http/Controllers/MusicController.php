<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

class MusicController extends Controller
{

    private $spotify_client_id;
    private $spotify_client_secret;
    private $spotify_redirect_uri;
    private $spotify_token;
    private $spotify_refresh_token;


    public function __construct()
    {

     /**
     * From config because they never change
     */
      $this->spotify_client_id = config("services.spotify.id");
      $this->spotify_client_secret = config("services.spotify.secret");
      $this->spotify_redirect_uri = "http://dashboard.test/dashboard/spotify/auth/";

      $this->spotify_token = config("services.spotify.token");
      $this->spotify_refresh_token = config("services.spotify.refresh_token"); 
    }


    public function index(Request $request) {

      // Si on a le code dans url
      if($request->input('code')){
        $request->session()->put('spotify_code', $request->input('code'));
        // Call getAccessToken();
        $this->getAccessToken($request->input('code'), $request);

        return redirect('/dashboard');
      }
      return view('spotify');
    }
    /**
     * Auth user
     */
    public function authUser() {
      $scope = "user-read-private%20user-read-email%20user-read-currently-playing";
      $url = "https://accounts.spotify.com/authorize?response_type=code&client_id={$this->spotify_client_id}&scope={$scope}&redirect_uri={$this->spotify_redirect_uri}";
      return redirect($url);

    }

    /**
    * Spotify get Access token
    */
    public function getAccessToken($code, Request $request) {
      $values = array(
        'grant_type' => "authorization_code",
        'code' => $code,
        'redirect_uri' => $this->spotify_redirect_uri,
      );
      $params = http_build_query($values);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,            "https://accounts.spotify.com/api/token" );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt($ch, CURLOPT_POST,           1 );
      curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
      
      curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($this->spotify_client_id.':'.$this->spotify_client_secret))); 
      $result=curl_exec($ch);

      
      $content = json_decode($result, true);
      $request->session()->put('spotify_token', $content['access_token']);
      $request->session()->put('spotify_refresh_token', $content['refresh_token']);

      return $content;

    }


    /**
    * Get current song
    */
    public function getCurrentSong(Request $request) {

      // \Config::set('services.testconfig.token', 'America/Chicago');

      $authorization = 'Authorization: Bearer '. $request->session()->get('spotify_token');
      $ch = curl_init();

      curl_setopt_array($ch,  array(
        CURLOPT_URL => "https://api.spotify.com/v1/me/player/currently-playing",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json, charset = utf-8',
          $authorization 
         ))
      );
      $result = curl_exec($ch);
      $content = json_decode($result, true);
      
      /**
       * Valider si le token est expiré
      */
      if(isset($content["error"])){
        return $this->refreshToken($request);
      }else{
        return $content;
      }
    }




    /**
    * Spotify refresh token
    */
    public function refreshToken(Request $request){

      $values = array(
        'grant_type' => "refresh_token",
        'refresh_token' => $request->session()->get('spotify_refresh_token'),
        'redirect_uri' => $this->spotify_redirect_uri,
      );
      $params = http_build_query($values);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,            "https://accounts.spotify.com/api/token" );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt($ch, CURLOPT_POST,           1 );
      curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
      
      curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($this->spotify_client_id.':'.$this->spotify_client_secret))); 
      $result = curl_exec($ch);
      $content = json_decode($result, true);

      $request->session()->put('spotify_token', $content['access_token']);
      
      return $content["access_token"];
    }
}
