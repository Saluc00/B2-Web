<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $historiques = DB::table('historique')->where('user_id', "=", Auth::user()->id)->orderBy('id', 'desc')->get();
        $genres = json_decode(file_get_contents('https://api.deezer.com/genre'));
        $res = [];
        foreach ($historiques as $historique) {
            array_push($res, json_decode(file_get_contents('https://api.deezer.com/track/'. (string) $historique->musique_id)) );
        }
        return view('home',[
            'res' => $res,
            'genres' => $genres,
        ]);
    }
}
