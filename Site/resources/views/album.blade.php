@extends('layouts.app')

@section('content')

<div id="presentationAlbum" class="d-flex flex-row justify-content-start">
<img src="{{ $json->{'cover_medium'} }}" class="p-2">

    <div id="descriptionAlbum" class="p-2">
        <div id="typeTitreAlbum">
            <p>ALBUM</p>
            <h1>{{ $json->{"title"} }}</h1>
        </div>

        <div id="parDateAlbum" class="p-2">
            <p>Par <strong><a href="/artiste/{{ $json->{'contributors'}[0]->{'id'} }}">{{ $json->{'contributors'}[0]->{'name'} }}</a></strong></p>
            <p>{{ $json->{"release_date"} }} | {{ $json->{"nb_tracks"} }} titres.</p>
            <button class="btn btn-primary d-block" onCLick="like('{{ $json->{'id'} }}', '{{ $json->{'type'} }}')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button>
        </div>
    </div>
</div>

<div id="listeMusiques">

    @foreach ($json->{'tracks'}->{'data'} as $music)
        <div class="d-flex flex-row justify-content-between list-group-item resultat-titre col-12 d-block">
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

<script src="{{ URL::asset('js/add.js') }}"></script>
<script src="{{ URL::asset('js/play.js') }}"></script>
<script src="{{ URL::asset('js/like.js') }}"></script>
@endsection