<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Start Bootstrap </div>
            <div class="list-group list-group-flush">
                <a href="/" class="list-group-item list-group-item-action bg-light">Accueil</a>
                <a href="/recherche" class="list-group-item list-group-item-action bg-light">Rechercher musique</a>
                <a href="#" onclick="show_prompt()" class="list-group-item list-group-item-action bg-light">Créer une nouvelle playlist</a> 
                <a href="/likes" class="list-group-item list-group-item-action bg-light">Mes coups de coeurs</a>       
                @php 
                    $res = [];
                    // playlist Like
                    $playlists = DB::table('likes')->where([
                        ['user_id', '=', (string) auth()->user()->id],
                        ['genre', '=', 'playlist'],
                    ])->get();
                    // Playlist des utilisateurs like
                    $playlistsUser = DB::table('likes')->where([
                        ['user_id', '=', (string) auth()->user()->id],
                        ['genre', '=', 'playlistUser'],
                    ])->get();
                    foreach ($playlistsUser as $playlist) {
                        $req = DB::table('playlists')->where([
                            ['id', '=', $playlist->item_id],
                        ])->get();
                        
                        try {                            
                            array_push($res, $req[0]);
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                    $playlistInDB = DB::table('playlists')->where([
                        ['user_id', '=', (string) auth()->user()->id],
                    ])->get();
                    foreach ($playlistInDB as $playlist) {
                        array_push($res, $playlist);
                    }
                    foreach ($playlists as $playlist) {
                        array_push($res, json_decode(file_get_contents('https://api.deezer.com/playlist/'. (string) $playlist->item_id)) );
                    }
                @endphp
                @if ($res ?? '' )
                        <p class="list-group-item list-group-item-action bg-light"><i>Toutes mes playlists: </i></p>
                            @foreach ($res as $playlist)
                                {{-- @if ($playlist[0]->id ?? '')
                                <a href="/playlist/{{ $playlist[0]->id }}" class="list-group-item list-group-item-action bg-light">{{ $playlist[0]->name }}</a>
                                @endif --}}
                                @if ($playlist->{'title'} ?? '')
                                    <a href="/playlist/{{ $playlist->{'id'} }}" class="list-group-item list-group-item-action bg-light">{{ $playlist->{'title'} }}</a>
                                @else 
                                    <a href="/playlistUser/{{ $playlist->id }}" class="list-group-item list-group-item-action bg-light">{{ $playlist->name }}</a>
                                @endif
                            @endforeach
                @endif
                <a href="/deconnexion" class="list-group-item list-group-item-action bg-light" style="bottom: 0; position: absolute;"><b>Déconnexion</b></a>
            </div>
        </div>
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom fixed-top">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0" id="nav">
                        <li class="nav-item">
                            @if (Auth::user()->hasRole('admin'))
                            <a class="nav-link" href="/admin">
                                Administration</span>
                            </a>
                                @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile/{{Auth::user()->id}}"><img  src="{{ URL::asset('img/user.png') }}" style="width: 20px; border-radius: 50%;">
                                {{Auth::user()->name}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="main" class="container-fluid">
                @section('content')
                @show
            </div>
        </div>
    </div>

    </div>
    <div id="play" class="border bg-light">
        <audio id="player" controls src="" class="lecteurMusique" type="audio/ogg">
            Your browser does not support the audio element.
        </audio>
    </div>

    <script type="module" src="js/index.js"></script>

    <script type="text/javascript">
        function show_prompt() {
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');    
            var name = prompt('Entrez un nom de playlist');
            let formData = new FormData();
            formData.append('name', name);
            console.log(typeof(name))
            if (name != null && name != "") {
                fetch('/creer/playlist', {
                    method: 'post',
                    credentials: 'same-origin',
                    headers: {
                    'X-CSRF-Token': token
                    },
                    body:  formData,
                }).then(rep => rep.json().then(repon => console.log(repon)))
                .catch(error => console.log(error)); 
            }
        }
    </script>
</body>

</html>
