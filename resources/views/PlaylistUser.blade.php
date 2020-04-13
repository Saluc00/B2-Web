@extends('layouts.app')

@section('content')

<div id="presentationPlaylist" class="d-flex flex-row">

    <div id="descriptionPlaylist" class="p-2">
        <div id="typeTitrePlaylist">
            <p>PLAYLIST de l'utilisateur: <b>{{ $userPlaylist }}</b>.</p>
            <h1>{{ $playlist->name }}</h1>
        </div>

        <div id="nombreAlbumPlaylist" class="p-2">
            <p>{{ $playlist->description ?? '' }}</p>
            {{-- <p>{{ $json ?? ''->{"nb_tracks"} }} titres.</p>
          <button class="btn btn-primary d-block" onCLick="like('{{ $json ?? ''->{'id'} }}', '{{ $json ?? ''->{'type'} }}')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button> --}}
          @if (Auth::user()->id == $playlist->user_id)  
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Modifier
                </button>
                <div class="dropdown-menu">
                    <form class="px-4 py-3" method="post" action="/update/playlist/{{ $playlist->id }}">
                        @csrf
                        <div class="form-group">
                            <label >Nom de la playlist</label>
                            <input type="text" name="name" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label >Description</label>
                            <textarea name="desc" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                  </div>
            </div>
            @endif
            @if (Auth::user()->id != $playlist->user_id)  
            <button class="btn btn-primary d-block" onCLick="like('{{ $playlist->{'id'} }}', 'playlistUser')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button>
            @endif
        </div>
    </div>
</div>

<div id="titrePlaylist" class="p-3">   
    <div class="d-flex flex-row justify-content-between resultat-titre col-12 d-block">
        <p class="col-3" >Titre</p>
        <p class="col-3" >Artiste</p>
        <p class="col-6" >Album</p>
    </div>
    @foreach ($musiques as $musique)
    <div class="d-flex flex-row justify-content-between list-group-item resultat-titre col-12 d-block">
        <a class="col-3" href="/album/{{ $musique->{'album'}->{'id'} }}">{{ $musique->title }}</a>
        <a class="col-3" href="/artiste/{{ $musique->{"artist"}->{'id'} }}" >{{ $musique->{'artist'}->{ "name" } }}</a>
        <a class="col-3" href="/album/{{ $musique->{'album'}->{'id'} }}">{{ $musique->{'album'}->{ "title" } }}</a>
        <span class="d-flex flex-row col-3 justify-content-around">
            <button class="btn btn-danger d-block" onclick="add('{{ $playlist->id }}','{{ $musique->{'id'} }}' )">Supprimer</button>
            <button class="btn btn-primary d-block" onCLick="like('{{ $musique->{'id'} }}', '{{ $musique->{'type'} }}')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button>
            <button class="btn btn-primary d-block" onCLick="play('{{ $musique->{'id'} }}', '{{ $musique->{'preview'} }}')"><img src='{{ URL::asset('img/play.png') }}' style="width:20px"/></button>
        </span>
    </div>
    @endforeach
</div>

<script src="{{ URL::asset('js/add.js') }}"></script>
<script src="{{ URL::asset('js/play.js') }}"></script>
<script src="{{ URL::asset('js/like.js') }}"></script>
<script src="{{ URL::asset('js/playlist.js') }}"></script>
@endsection