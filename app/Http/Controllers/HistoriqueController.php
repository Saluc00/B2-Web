<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{
    public function add($id)
    {
        $user = (string) auth()->user()->id; 
        DB::table('historique')->insertGetId(
            ['musique_id' => $id , 'user_id' => $user],
        );
    }
}
