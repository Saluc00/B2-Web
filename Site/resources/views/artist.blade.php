@extends('layouts.app')

@section('content')

<div id="presentationArtiste" class="d-flex flex-row">
    <img src="{{ $json->{'picture_medium'} }}">

    <div id="descriptionArtiste" class="p-2">
        <div id="typeTitreArtiste">
            <p>ARTISTE</p>
            <h1>{{ $json->{"name"} }}</h1>
        </div>

        <div id="nombreAlbumArtiste" class="p-2">
            <p>{{ $json->{"nb_album"} }} albums.</p>
            <button class="btn btn-primary d-block" onCLick="like('{{ $json->{'id'} }}', '{{ $json->{'type'} }}')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button>
        </div>
    </div>
</div>

<div id="top5">
    <h2 class="p-3">5 titres les plus écoutés</h2>
    <hr/>
    @foreach ($top5->{'data'} as $music)
    <div class="d-flex flex-row justify-content-between list-group-item resultat-titre col-8 d-block">
        {{ $music->title }}
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

@if ($albums->{'data'} != [])
<h2 class="p-3">Albums</h2>
<hr/>
<div id="albums" class="d-flex flex-wrap">
    @foreach ($albums->{'data'} as $album)
    <a href="/album/{{ $album->{'id'} }}" class="card m-2" style="width: 18rem;">
        <img src="{{ $album->{'cover_big'} }}" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{ $album->{"title"} }}</h5>
        </div>
    </a>
    @endforeach
</div>
@endif


@if ($playlists->{'data'} ?? '')
<h2 class="p-3">Playlist</h2>
<hr/>
<div id="playlists" class="d-flex flex-wrap">
    @foreach ($playlists->{'data'} as $playlist)
    <a href="/playlist/{{ $playlist->{'id'} }}" class="card m-2" style="width: 18rem;">
        <img src="{{ $playlist->{'picture_big'} }}" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{ $playlist->{"title"} }}</h5>
        </div>
    </a>
    @endforeach
</div>
@endif

<script src="{{ URL::asset('js/add.js') }}"></script>
<script src="{{ URL::asset('js/play.js') }}"></script>
<script src="{{ URL::asset('js/like.js') }}"></script>
@endsection