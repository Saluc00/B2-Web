<?php

namespace App\Http\Controllers;

use App\Playlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index($id)
    {
        $user = (string) auth()->user()->id; 
        $playlistsUser = DB::table('playlists')->where([
            ['user_id', '=', (string) $user]
        ])->get();
        $json = json_decode(file_get_contents('https://api.deezer.com/playlist/'. $id));
        return view('playlist', [
            'json' => $json,
            'playlistsUser' => $playlistsUser,
        ]);
    }

    public function creer(Request $data)
    {
        $user = (string) auth()->user()->id; 
        return DB::table('playlists')->insertGetId(
            ['name' => (string) $data['name'], 'user_id' => $user],
        );
    }

    public function playlistUser($id)
    {
        $playlist = DB::table('playlists')->where([
            ['id', '=', $id]
        ])->get();
        $requeteMusiques = DB::table('playlist_musique')->where([
            ['playlist_id', '=', $id],
        ])->get();
        $musiques = [];
        foreach ($requeteMusiques as $musique) {
            array_push($musiques, json_decode(file_get_contents('https://api.deezer.com/track/'. (string) $musique->musique_id)) );
        }
        $userPlaylist = DB::table('users')->where('id', '=', $playlist[0]->user_id)->get()[0];
        return view('playlistUser', [
            'playlist' => $playlist[0],
            'musiques' => $musiques,
            'userPlaylist' => $userPlaylist->name,
        ]);
    }

    public function addMusiquePlaylist($idP, $idM) 
    {
        $test = DB::table('playlist_musique')->where([
            ['playlist_id', '=', $idP],
            ['musique_id', '=', $idM],
        ])->get();
        if (empty($test[0]))
        {
            return DB::table('playlist_musique')->insertGetId(
                ['playlist_id' => $idP, 'musique_id' => $idM ]
            );
       } else
       {
            DB::table('playlist_musique')->where([
                ['playlist_id', '=', $idP],
                ['musique_id', '=', $idM],
            ])->delete();
        }
    }

    public function update($id, Request $request)
    {
        if ($request['name']) {
            DB::update('update playlists set name = ? where id = ?', [$request['name'], $id]);
        }
        if ($request['desc']) {
            DB::update('update playlists set description = ? where id = ?', [$request['desc'], $id]);
        }
        return back();
    }

    public function delete($id)
    {
        DB::table('playlist_musique')->where('playlist_id', '=',(integer) $id)->delete();
        DB::table('playlists')->where('id', '=',(integer) $id)->delete();
        return back();
    }
}
