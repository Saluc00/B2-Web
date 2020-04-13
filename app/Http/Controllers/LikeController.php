<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index()
    {
        $user = (string) auth()->user()->id; 
        $likes = DB::table('likes')->distinct()->where('user_id', '=', $user)->get();
        $res = [];
        foreach ($likes as $like) {
            array_push($res, json_decode(file_get_contents('https://api.deezer.com/'.(string) $like->genre . '/'. (string) $like->item_id)) );
        }
        return view('like', [
            'res' => $res,
        ]);
    }

    public function add($genre, $id)
    {
        // 'track', 'album', 'artist', 'playlist'
        $user = (string) auth()->user()->id; 
        $test = DB::table('likes')->where([
            ['item_id', '=', $id],
            ['user_id', '=',(string) $user]
        ])->get();
        if (empty($test[0]))
        {
            DB::table('likes')->insertGetId(
                ['item_id' =>(string) $id , 'genre' =>(string) $genre, 'user_id' =>(string) $user],
            );
        } else
        {
            DB::table('likes')->where([
                ['item_id', '=', $id],
                ['user_id', '=',(string) $user]
            ])->delete();
        }

    }
}
