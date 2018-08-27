<?php

namespace App\Services\Spotify;
use Auth;
use Illuminate\Http\Request;
use App\SpotifyModel;
use Illuminate\Support\Facades\DB;

class Spotify
{

    public function __construct()
    {

    }

    public static function infos(): array
    
    {   $jsonPath = file_get_contents(base_path('resources/spotify.json'));
        return json_decode($jsonPath, true);
    }


    public static function storeInJson($content): string
    {   
        
        $jsonPath = file_get_contents(base_path('resources/spotify.json'));
        $data = json_decode($jsonPath, true);

        // Update Key
        $data['song']['name'] = $content['item']['name'];
        $data['artiste']['name'] = $content['item']['artists'][0]['name'];
        $data['album']['name'] = $content['item']['album']['name'];


        // Write File

        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

        file_put_contents(base_path('resources/spotify.json'), stripslashes($newJsonString));
        return 'Data save';
    }

    /**
     * Save spotify credentials to database
     */
    public static function saveCredentials($token, $refresh_token) {

        return SpotifyModel::create([
            'user_id' => Auth::id(),
            'token' => $token,
            'refresh_token' => $refresh_token,
        ]);

    }

    /**
     * Save spotify credentials to database
     */
    public static function updateCredentials($token) {


        DB::table('spotify')->where('user_id', Auth::id())->update(['token' => $token]);
        return "Token update";

    }


    /**
     * Get spotify info by user connect
     * @return Array : Avec les informations passés en paramêtres
    */
    public static function getCredentials(): object  {

        /**
         * Appel à la base de donnée 
         * @return array 
        */
        $query = DB::table('spotify')->select('token', 'refresh_token')->where('user_id', Auth::id())->get()->toArray();


        /*
        * Valide si l'utilisateur a des informations
        * Il est posssible que l'utilisateur n'ai pas connecté son compte Spotify encore. 
        */
        if(!empty($query)){

            $has_credentials = true;
            $token = $query[0]->token;
            $refresh_token = $query[0]->refresh_token;

        }else{

            $has_credentials = false;
            $token = null;
            $refresh_token = null;
        }

        

        /**
         *  Transformer l'objet de la query en tableau 
         */
        $data = (object)  [
            "has_credential" => $has_credentials,
            "token" => $token,
            "refresh_token" =>$refresh_token,
        ];
        return $data;
    }   


}
