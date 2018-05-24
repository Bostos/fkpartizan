<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <title>FK Partizan - Prijava</title>

    <link rel="shortcut icon" href="{{{asset('favicon.png')}}}">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet/less" href="{{asset('css/partizan.less')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}">
    <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Anton" type='text/css'>
    <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto" type='text/css'>
    <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Oswald" type='text/css'>
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('scss/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="{{route('/')}}">
                        <img class="align-content" style="width: 100px; height: 100px;" src="{{asset('images/logos/partizan.png')}}" alt="partizan logo">
                    </a>
                </div>
                <div class="login-form">
                    <form method="post" action="{{route('do-login')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Korisničko ime</label>
                            <input type="text" class="form-control" name="username" placeholder="Korisničko ime" value="{{old('username')}}" @if($errors->any()) style="border: 1px solid red;" @endif>
                        </div>
                        <div class="form-group">
                            <label>Lozinka</label>
                            <input type="password" class="form-control" name="password" placeholder="Lozinka" @if($errors->any()) style="border: 1px solid red;" @endif>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Zapamti me
                            </label>
                            <label class="pull-right">
                                <a href="#">Zaboravili ste lozinku?</a>
                            </label>

                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Prijavi se</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Nemate nalog?<a href="#"> Registrujte se</a></p>
                        </div>
                    </form>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger" align="center">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger" align="center"> {{session('error')}} </div>
                @endif
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>


</body>
</html>