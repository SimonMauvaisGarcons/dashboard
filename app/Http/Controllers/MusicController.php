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
      $this->spotify_client_id = config("services.spotify.id");
      $this->spotify_client_secret = config("services.spotify.secret");
      $this->spotify_redirect_uri = "http://dashboard.test/dashboard/spotify/redirect-uri";
      $this->spotify_token = config("services.spotify.token");
      $this->spotify_refresh_token = config("services.spotify.refresh_token"); 
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
    * Spotify get Acces token
    */
    public function getAccessToken() {
      $authCode = "AQDOvytbcZMue737MudeT2lhLfNQvSWnfMRT7_IDDMfTpomsYcArTft5VCimuCD6K9Ihnn5IdkPGYplbz_9UBoaRHNZ13Nkkcr17YcA_GY3VqvrrHydNB4yAWsbA96fjM2wsQ6vcWoWmA5dJk8_QYcRMQe3plYoqmvZFdbjPnL05DfyLY2CoHCUh8GcSPfFP7_wwPt0_9pUxJkW9g5vdxDg8umTg9v53kCPFqdsr0EyOiOUVWnfIOJVNHr8fJyP2Vs9Nxe9wYlUWrUGaaceHFRk3LwXa4BUc5lDvPPsdK7sqJdmQdL0tZ2R6hg";
      $values = array(
        'grant_type' => "authorization_code",
        'code' => $authCode,
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
      return $result;

    }

    /**
    * Spotify refresh token
    */
    public function refreshToken(){

      $values = array(
        'grant_type' => "refresh_token",
        'refresh_token' => $this->spotify_refresh_token,
        // 'redirect_uri' => $this->spotify_redirect_uri,
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

      return $content["access_token"];
    }

    /**
    * Get current song
    */
    public function getCurrentSong() {

      // \Config::set('services.testconfig.token', 'America/Chicago');

      $authorization = 'Authorization: Bearer '.$this->spotify_token;
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
        return $this->refreshToken();
      }else{
        return $content;
      }
    }
}
