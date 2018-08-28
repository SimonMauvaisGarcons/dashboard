<?php

namespace App\Services\Twitch;
use App\TwitchModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Auth;
class Twitch
{
    public static function goToUrl()
    {   
        exec('open https://www.twitch.tv/ninja');
    }

    public static function store($id , $player_username)
    {   
        return TwitchModel::create([
            'user_id' => Auth::id(),
            'identifiant' => $id,
            'player_username' => $player_username,
        ]);
    }

    public static function update($id, $player_username)
    {   
        DB::table('twitch')->where('user_id', Auth::id())->update(['identifiant' => $id, 'player_username' => $player_username]);
        return 'twitch user update';
    }

    public static function get()
    {
        /**
         * Appel à la base de donnée 
         * @return array 
        */
        $query = DB::table('twitch')->select("player_username", "identifiant" )->where('user_id', Auth::id())->get()->toArray();

        
        /*
        * Valide si l'utilisateur a des informations
        * Il est posssible que l'utilisateur n'ai pas connecté son compte Spotify encore. 
        */
        if(!empty($query)){
            $has_twitch_id = true;
            $id = $query[0]->identifiant;
            $username = $query[0]->player_username;
        }else{
            $has_twitch_id= false;
            $id = null;
            $username = "";
        }

        
         /**
         *  Transformer l'objet de la query en tableau 
         */
        $data = (object)  [
            "has_twitch_id" => $has_twitch_id,
            "identifiant" => $id,
            "username" => $username,
        ];

        

        return $data;
    }



}
