<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use App\Services\Twitch\Twitch;
use Illuminate\Http\Request;

class TwitchController extends Controller
{
    

    public function index(){

        $twitch_id = "9gro76wo69bdqkewo808ki8xabarsf";

        $ch = curl_init();

        curl_setopt_array($ch,  array(
          CURLOPT_URL => "https://api.twitch.tv/kraken/streams/19571641",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Accept: application/vnd.twitchtv.v5+json",
            "Client-ID: {$twitch_id}",
           ))
        );


        
        $result = curl_exec($ch);
        $content = json_decode($result, true);
        return $content;
    }


    public function updateUser(Request $request) {

        $twitch_id = "9gro76wo69bdqkewo808ki8xabarsf";

        $ch = curl_init();
        
        
        curl_setopt_array($ch,  array(
          CURLOPT_URL => "https://api.twitch.tv/helix/users?login=".$request->input('username') ,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Accept: application/vnd.twitchtv.v5+json",
            "Client-ID: {$twitch_id}",
           ))
        );

        $result = curl_exec($ch);
        $content = json_decode($result, true);

        $id = $content['data'][0]['id'];
        $name = $content['data'][0]['login'];

        

        /**
         * Store to database
        */
       
        if($request->input('twitch') == "false"){
            Twitch::store($id, $name);
        }else{
            Twitch::update($id, $name);
        }
    
        return $content;

    }
}
