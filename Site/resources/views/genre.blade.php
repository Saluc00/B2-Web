@extends('layouts.app')

@section('content')

<div class="container-fluid">
<h1 class="p-3 text-center">{{ $genre->{'name'} }}<h1>
<hr/>

@if ($artistes ?? '')
    <h2 class="p-3">Artistes de ce genre</h2>
    <div id="ArtistesGenre" class="d-flex flex-wrap justify-content-around">
    @foreach ($artistes->{'data'} as $artiste)
        <a href="/artiste/{{ $artiste->{'id'} }}" class="card m-2" style="width: 18rem;">
            <img src="{{ $artiste->{'picture_big'} }}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ $artiste->{"name"} }}</h5>
            </div>
        </a>
    @endforeach
    </div>
@endif

</div>
@endsection