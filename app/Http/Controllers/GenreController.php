<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index($id)
    {
        $artistes = json_decode(file_get_contents('https://api.deezer.com/genre/'.$id.'/artists'));
        $genre = json_decode(file_get_contents('https://api.deezer.com/genre/'.$id ));
        return view('genre', [
            'id' =>  $id,
            'artistes' => $artistes,
            'genre' => $genre,
        ]);
    }
}
