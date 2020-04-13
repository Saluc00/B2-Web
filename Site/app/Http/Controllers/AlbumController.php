<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index($id) {
        $json = json_decode(file_get_contents('https://api.deezer.com/album/'. $id));
        $user = (string) auth()->user()->id; 
        $playlistsUser = DB::table('playlists')->where([
            ['user_id', '=', (string) $user]
        ])->get();
        return view('album', [
            'id' => $id,
            'json' => $json,
            'playlistsUser' => $playlistsUser,
        ]);
    }
}
