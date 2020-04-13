@extends('layouts.app')

@section('content')

<h1 class="p-3 text-center">Recherche</h1>
<hr/>
<form onsubmit="return false;">
    <div class="input-group mb-3 m-3 p-3">
        <input type="text" class="form-control col-8 p-3" placeholder="Recherche" id="motsRecherches" />
        <div class="input-group-append">
            <button class="btn btn-primary" id="boutonRecherche">Chercher</button>
        </div>
      </div>
</form>

<div id="resultats">

</div>

<script src="{{ URL::asset('js/play.js') }}"></script>
@endsection
