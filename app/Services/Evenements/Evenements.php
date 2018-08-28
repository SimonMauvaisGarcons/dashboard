<?php

namespace App\Services\Evenements;
use Illuminate\Support\Facades\DB;
use Auth;

class Evenements
{


    public static function update($id, $player_username)
    {   
        // DB::table('twitch')->where('user_id', Auth::id())->update(['identifiant' => $id, 'player_username' => $player_username]);
        // return 'twitch user update';
    }

    public static function get()
    {
        /**
         * Appel à la base de donnée 
         * @return array 
        */
        $query = DB::table('evenements')->select('*')->where('user_id', Auth::id())->get()->toArray();
        return $query;
    }


    public static function delete($id)
    {
        $query = DB::table('evenements')->where([
            ['user_id', Auth::id()],
            ['id_event', $id],
        ])->delete();

        return $query;
    }


}
