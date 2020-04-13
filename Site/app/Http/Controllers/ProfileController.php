<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index($id) {
        $req = DB::table('users')->where('id', '=', $id)->get()[0];
        // var_dump($url); die();
        return view('profile', [
            'id'=> $id,
            'name' => $req->name,
            'email' => $req->email,
        ]);
    }

    public function update($id, Request $request)
    {
        if ($request['name']) {
            DB::update('update users set name = ? where id = ?', [$request['name'], $id]);
        }
        if ($request['email']) {
            DB::update('update users set email = ? where id = ?', [$request['email'], $id]);
        }
        if ($request['password'] && $request['verif'] && $request['password'] === $request['verif']) {
            DB::update('update users set password = ? where id = ?', [Hash::make($request['password']), $id]);
        }
        return back();
    }
}
