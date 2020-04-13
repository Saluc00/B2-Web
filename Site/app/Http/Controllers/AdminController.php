<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Playlist;
use \Spatie\Permission\Models\Role;
use \Illuminate\Support\Collection; 
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() 
    {
        $users = User::all();
        $roles = Role::all();
        $playlist = Playlist::all();
        return view('admin', [
            'users' => $users,
            'roles' => $roles,
            'playlist' => $playlist,
        ]);
    }

    public function change($idUser, $idRole)
    {
        DB::update('update model_has_roles set role_id = ? where model_id = ? and model_type = ?', [$idRole, $idUser, "App\User"]);
        return redirect('/admin');
    }
}
