<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Spotify\Spotify;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spotify = Spotify::getCredentials();
        return view('profile', ['spotify' => $spotify]);
    }
}
