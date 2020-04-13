@extends('layouts.app')

@section('content')

<h1 class="text-center p-3">Vos coups de <3 </h1>
<hr/>

@if ($res ?? '')
    <h2 class="p-3">Titre</h2>
    <hr/>
    @foreach ($res as $result)
        @if ($result->error ?? '')
            @continue
        @endif
        @if ($result->{'type'} == 'track')
            <div class="d-flex flex-row justify-content-between list-group-item resultat-titre col-12 d-block">
                <a class="col-3" href='/album/{{ $result->{'album'}->{'id'} }}'>{{ $result->{"title"} }}</a>
                <a class="col-3" href='/artiste/{{ $result->{'artist'}->{'id'} }}'>{{ $result->{'artist'}->{"name"} }}</a>
                <a class="col-3" href='/album/{{ $result->{'album'}->{'id'} }}'>{{ $result->{'album'}->{"title"} }}</a>
                <span class="d-flex flex-row col-3 justify-content-around">
                    <button class="btn btn-primary d-block" onCLick="like('{{ $result->{'id'} }}', '{{ $result->{'type'} }}')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button>
                    <button class="btn btn-primary d-block" onCLick="play('{{ $result->{'id'} }}', '{{ $result->{'preview'} }}')"><img src='{{ URL::asset('img/play.png') }}' style="width:20px"/></button>
                </span>
        
            </div>
        @endif
    @endforeach

    <h2 class="p-3">Playlist</h2>
    <hr/>
    <div class="d-flex flew-wrap justify-content-around">
    @foreach ($res as $result)
    @if ($result->error ?? '')
        @continue
    @endif
        @if ($result->{'type'} == 'playlist')
            <a href="/playlist/{{ $result->{'id'} }}" class="card m-2" style="width: 18rem;">
                <img src="{{ $result->{'picture_big'} }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $result->{"title"} }}</h5>
                </div>
            </a>
        @endif
    @endforeach
    </div>

    <h2 class="p-3">Album</h2>
    <hr/>
    <div class="d-flex flew-wrap justify-content-around">
    @foreach ($res as $result)
        @if ($result->error ?? '')
            @continue
        @endif
        @if ($result->{'type'} == 'album')
            <a href="/album/{{ $result->{'id'} }}" class="card m-2" style="width: 18rem;">
                <img src="{{ $result->{'cover_big'} }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $result->{"title"} }}</h5>
                </div>
            </a>
        @endif
    @endforeach
    </div>
    
    <h2 class="p-3">Artiste</h2>
    <hr/>
    <div class="d-flex flew-wrap justify-content-around">
    @foreach ($res as $result)
        @if ($result->error ?? '')
            @continue
        @endif
        @if ($result->{'type'} == 'artist')
            <a href="/artiste/{{ $result->{'id'} }}" class="card m-2" style="width: 18rem;">
                <img src="{{ $result->{'picture_big'} }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $result->{"name"} }}</h5>
                </div>
            </a>
        @endif
    @endforeach
    </div>

@else 
    <h3>.... Pas encore de coup de coeur</h3>
@endif


<script src="{{ URL::asset('js/play.js') }}"></script>
<script src="{{ URL::asset('js/like.js') }}"></script>
@endsection