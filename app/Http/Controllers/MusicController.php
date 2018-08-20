<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SpotifyEvent;


class MusicController extends Controller
{
    //
    public function index(){
      // Broadcast event
      event(new SpotifyEvent());
      return "Event Spotify broadcast";
    }
}
