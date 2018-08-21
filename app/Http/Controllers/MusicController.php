<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SpotifyEvent;


class MusicController extends Controller
{
    //
    public function index(){

      //dd(config('broadcasting.connections.pusher'));

      // Broadcast event
      event(new SpotifyEvent());
      return "Event Spotify broadcast";
    }




    /**
     * Auth user
     */
    public function authUser() {

      $client_id = config("services.spotify.id"); 
      $client_secret = config("services.spotify.secret");
      $scope = "user-read-private%20user-read-email%20user-read-currently-playing";
      $redirect_uri = "http://dashboard.test/dashboard/spotify/redirect-uri";
      $url = "https://accounts.spotify.com/authorize?response_type=code&client_id={$client_id}&scope={$scope}&redirect_uri={$redirect_uri}";

      return redirect($url);

    }


    /**
    * Spotify get Acces token
    */
    public function getAccessToken() {

      $client_id = config("services.spotify.id"); 
      $client_secret = config("services.spotify.secret");
      $authCode = "AQAh4WMC1QsPcnMlo7ykQtmiuUORIbcvUJfh6wNkt0ceiK_0aY84KObSxHQkbqsQqt8ecfURq7fSBEyi4OYk_YiiK4_nIyQEOKY4oUobofAFIjJnBNhXpOnsehfxR8fi6uCHJbJN3Fp-qsDJxl7o7YobnfRX5pbiYao-BgaLtKwiW4FEieQy06Q0M2F-2NyBG4lPzfggVMZRH-7Za_7trMtbD2f9F5pW8C8mOKX2bsUAOr-yh2eDQ4Ur38-SBP_Y8xOLq8dwcEiLnqU_PcWxYYhMscJKC5kPfdH03P40n7fesEQomfTHHYd8Jw";
      $values = array(
        'grant_type' => "authorization_code",
        'code' => $authCode,
        'redirect_uri' => "http://dashboard.test/dashboard/spotify/redirect-uri",
      );
    
      $params = http_build_query($values);

      $ch = curl_init();


      curl_setopt($ch, CURLOPT_URL,            "https://accounts.spotify.com/api/token" );
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt($ch, CURLOPT_POST,           1 );
      curl_setopt($ch, CURLOPT_POSTFIELDS, $params); 
      curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
      
      $result=curl_exec($ch);
      return $result;

    }


    /**
    * Get current song
    */
    public function getCurrentSong() {

      $client_id = config("services.spotify.id");
      $token = config("services.spotify.token");
      $authorization = 'Authorization: Bearer '.$token;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/me/player/currently-playing" );
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
  
      $result = curl_exec($ch);
      return json_decode($result);
    }



}
