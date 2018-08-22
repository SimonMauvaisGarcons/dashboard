<?php

namespace App\Services\Spotify;
use Illuminate\Http\Request;

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

}
