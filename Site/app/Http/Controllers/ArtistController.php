<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index($id) {
        $user = (string) auth()->user()->id; 
        $json = json_decode(file_get_contents('https://api.deezer.com/artist/'. $id));
        $top5 = json_decode(file_get_contents('https://api.deezer.com/artist/'. $id.'/top'));
        $albums = json_decode(file_get_contents('https://api.deezer.com/artist/'. $id.'/albums'));
        $playlists = json_decode(file_get_contents('https://api.deezer.com/artist/'. $id.'/playlists'));
        $playlistsUser = DB::table('playlists')->where([
            ['user_id', '=', (string) $user]
        ])->get();
        return view('artist', [
            'json' => $json,
            'top5' => $top5,
            'albums' => $albums,
            'playlists' => $playlists,
            'playlistsUser' => $playlistsUser,
        ]);
    }
}
