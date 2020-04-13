@extends('layouts.app')

@section('content')

<div id="presentationPlaylist" class="d-flex flex-row">
    <img src="{{ $json->{'picture_medium'} ?? $playlist->image }}">

    <div id="descriptionPlaylist" class="p-2">
        <div id="typeTitrePlaylist">
            <p>PLAYLIST</p>
            <h1>{{ $json->{"title"} ?? $playlist->name }}</h1>
        </div>

        <div id="nombreAlbumPlaylist" class="p-2">
            <p>{{ $json->{"nb_tracks"} }} titres.</p>
            <button class="btn btn-primary d-block" onCLick="like('{{ $json->{'id'} }}', '{{ $json->{'type'} }}')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button>
        </div>
    </div>
</div>

<div id="titrePlaylist" class="p-3">   
    <div class="d-flex flex-row justify-content-between resultat-titre col-12 d-block">
        <p class="col-3" >Titre</p>
        <p class="col-3" >Artiste</p>
        <p class="col-6" >Album</p>
    </div>
    @foreach ($json->{'tracks'}->{'data'} as $music)
    <div class="d-flex flex-row justify-content-between list-group-item resultat-titre col-12 d-block">
        <a class="col-3" href="/album/{{ $music->{'album'}->{'id'} }}">{{ $music->title }}</a>
        <a class="col-3" href="/artiste/{{ $music->{"artist"}->{'id'} }}" >{{ $music->{'artist'}->{ "name" } }}</a>
        <a class="col-3" href="/album/{{ $music->{'album'}->{'id'} }}">{{ $music->{'album'}->{ "title" } }}</a>
        <span class="d-flex flex-row col-3 justify-content-around">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="{{ URL::asset('img/plus.png') }}" style="width:20px" />
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach ($playlistsUser as $playlistUser)
                        <button class="dropdown-item" onclick="add('{{ $playlistUser->id }}','{{ $music->id }}' )">{{ $playlistUser->name }}</button>
                    @endforeach
                </div>
              </div>
            <button class="btn btn-primary d-block" onCLick="like('{{ $music->{'id'} }}', '{{ $music->{'type'} }}')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button>
            <button class="btn btn-primary d-block" onCLick="play('{{ $music->{'id'} }}', '{{ $music->{'preview'} }}')"><img src='{{ URL::asset('img/play.png') }}' style="width:20px"/></button>
        </span>
    </div>
    @endforeach
</div>

<script src="{{ URL::asset('js/add.js') }}"></script>
<script src="{{ URL::asset('js/play.js') }}"></script>
<script src="{{ URL::asset('js/like.js') }}"></script>
@endsection