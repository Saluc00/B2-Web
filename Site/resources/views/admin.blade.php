@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h1 class="text-center p-3">Administration</h1>
    <hr>

    <div class="d-flex flex-row justify-content-between p-3">
        <div class="col-6 d-block">
            <h2 class="text-center p-1">Tous les utilisateurs</h2>
            <hr>
            @foreach ($users as $user)
                <div class="d-flex flex-row justify-content-around p-1">
                    <p class="col-4"><b>{{ $user->name }}</b> est un: <b>{{ $user->getRoleNames()[0] }}</b></p>
                    <div class="dropdown show col-2">
                        <a class="btn btn-secondary dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Changer role
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach ($roles as $role)
                                <a class="dropdown-item supprRole" href="/admin/change/{{ $user->id }}/{{ $role->id }}" onclick="change()">{{ $role->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="col-6 d-block">
            <h2 class="text-center p-1">Playlist créers par les utilisateurs</h2>
            <hr>
            @foreach ($playlist as $p)
            <div class="d-flex flex-row justify-content-around p-1">
                <p class="col-4"><b>{{ $p->name }}</b> appartient à: <b>{{ DB::table('users')->where('id', '=', $p->user_id)->get()[0]->name }}</b>.</p>
                <div class="show col-2">
                    <a class="btn btn-danger gle " href="/delete/playlist/{{ $p->id }}">
                      Supprimer
                    </a>
                </div>
            </div>
        @endforeach
        </div>

    </div>
</div>

@endsection