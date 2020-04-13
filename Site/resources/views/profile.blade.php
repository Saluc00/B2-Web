@extends('layouts.app')

@section('content')


<h1 class="p-3 text-center">Page de votre profile</h1>
<hr/>

<div class="container-fluid">
    <div id="profile" class="col-12 d-flex flex-row justify-content-around p-3">
        @if ($img ?? '')
        <img src="{{ $img  }}" style="width: 200px; border-radius: 50%;">
        @else
        <img  src="{{ URL::asset('img/user.png') }}" style="width: 200px; border-radius: 50%;">
        @endif
        <div class="col-6">
            <p>Pseudo: <b>{{ $name }}</b></p>
            <p>Email: <b>{{ $email }}</b></p>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Modifier compte
                </button>
                <div class="dropdown-menu">
                    <form class="px-4 py-3" method="post" action="/profile/{{ $id }}">
                        @csrf
                        <div class="form-group">
                            <label for="pseudo">Pseudo</label>
                            <input name="name" type="text" class="form-control" id="pseudo"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleDropdownFormEmail1">Adresse email</label>
                            <input name="email" type="email" class="form-control" id="exampleDropdownFormEmail1"/>
                        </div>    
                        <div class="form-group">
                            <label for="exampleDropdownFormPassword1">Mot de passe</label>
                            <input name="password" type="password" class="form-control" id="exampleDropdownFormPassword1"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleDropdownFormPassword2">Verification du mot de passe</label>
                            <input name="verif" type="password" class="form-control" id="exampleDropdownFormPassword2"/>
                        </div>
                        <hr/>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<hr/>

@endsection