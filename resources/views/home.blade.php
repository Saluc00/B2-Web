@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="text-center p-3">Accueil</h1>
    <hr>
    @if ($res ?? '' )
    <h2 class="p-2">Historique</h2>
        <div id="listHistorique" class="d-flex flex-wrap justify-content-around overflow-auto border rounded" style="max-height: 200px;">
        @foreach ($res ?? '' as $result)
            <div class="d-flex flex-row justify-content-between p-1 col-4 border rounded">
                
                <h5 class="2 p-1"><a href="/artiste/{{ $result->{'artist'}->{"id"} }}">{{ $result->{"title"} }}</a></h5>
                <span class="d-flex flex-row col-2 justify-content-around m-1">
                    <button class="btn btn-primary d-block m-1" onCLick="like('{{ $result->{'id'} }}', '{{ $result->{'type'} }}')"><img src='{{ URL::asset('img/heart.png') }}' style="width:20px"/></button>
                    <button class="btn btn-primary d-block m-1" onCLick="play('{{ $result->{'id'} }}', '{{ $result->{'preview'} }}')"><img src='{{ URL::asset('img/play.png') }}' style="width:20px"/></button>
                </span>
            </div>
            @endforeach
        </div>
    @endif

    @if ($genres ?? '')
    <h2 class="p-2">Tout les genres</h2>
    <div class="d-flex flex-wrap justify-content-around">
        @foreach ($genres->{'data'} as $genre)
            @if ($genre->{'name'} != 'Tous' && $genre->{'name'} != 'Livres audio')
            <a href="/genre/{{ $genre->{'id'} }}" class="card m-2" style="width: 18rem;">
                <img src="{{ $genre->{'picture_big'} }}" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $genre->{"name"} }}</h5>
                </div>
            </a>
            @endif
        @endforeach
    </div>
    @endif
</div>


<script src="{{ URL::asset('js/play.js') }}"></script>
@endsection
