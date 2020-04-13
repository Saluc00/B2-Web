
<html>

<head>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('styleConn.css') }}">
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

    <section class='login'>
      <div class='login--wrap clearfix'>
        <div class="row clearfix">
          <div class="col col-6 login--l">
            <div class="title"><span class='text'>Login</span></div>
            <form class='login--body' method="POST" action="{{ route('login') }}">
                @csrf
              <label>
                <div class='label'>Email address</div>
                <input type='text' placeholder='votre@email.ici' name="email" required />
              </label>
              <label>
                <div class='label'>Password</div>
                <input type='password' placeholder='*********' name="password" required />
              </label>
              <div class='sbmt'>
                <button class='sbmt--btn'>Login</button>
              </div>
            </form>
          </div>
          <div class="col col-6 login--s">
            <div class="title"><span class='text'>Signup</span></div>
            <form class='login--body' method="POST" action="{{ route('register') }}">
                @csrf
                <label>
                <div class='label'>Username</div>
                <input type='text' placeholder='pseudo' name="name" required />
              </label>
              <label>
                <div class='label'>Email address</div>
                <input type='text' placeholder='votre@email.ici' name="email" required />
              </label>
              <label>
                <div class='label'>Password</div>
                <input type='password' placeholder='*********' name="password" required />
              </label>
              <label>
                <div class='label'>Confirm password</div>
                <input type='password' placeholder='*********' name="password_confirmation" required />
              </label>
              <div class='sbmt'>
                <button class='sbmt--btn'>Signup</button>
              </div>
            </form>
          </div>
        </div>
    </section>
  
</body>

</html>