<?php

namespace App\Services\Twitch;
use Illuminate\Http\RedirectResponse;

class Twitch
{
    public static function goToUrl()
    {   
        exec('open https://www.twitch.tv/ninja');
    }
}
