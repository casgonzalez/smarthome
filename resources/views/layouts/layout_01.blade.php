<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Smart Home | @yield('title')</title>
    <link rel="icon" href="{{asset('imagenes/icons/045-smart home.png')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdb.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    @yield('style_css')
</head>
<body class="">
    <header id="header" class="mb-5">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark mdb-color darken-3 scrolling-navbar">
            <div class="container">
                <a class="navbar-brand text-uppercase" href="{{asset('/')}}">
                    <img src="{{asset('imagenes/icons/011-sensor.png')}}" class="logo-avatar" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav nav-flex-icons">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item {{request()->is('administracion') ? 'active' : ''}}">
                                <a class="nav-link" href="/">
                                    <i class="fas fa-home"></i> Inicio <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            @if(Auth::user()->isAdmin())
                                <li class="nav-item {{request()->is('administracion/usuarios*') ? 'active' : ''}}">
                                    <a class="nav-link" href="{{asset('/administracion/usuarios')}}">
                                        <i class="fas fa-users"></i>
                                        Usuarios
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->isAdmin())
                            <li class="nav-item  dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                    <i class="fas fa-bell"></i>
                                    <span class="badge badge-danger nt">{{$notificaciones->count()}}</span>
                                    Notificaciones
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($notificaciones as $nt)
                                        <a class="dropdown-item" href="{{asset('perfil')}}">
                                            {{$nt->label}} ({{$nt->nombre}} ) <br>
                                            {{$nt->created_at}}
                                        </a>
                                        <div class="divider"></div>
                                    @endforeach

                                </div>
                            </li>
                            @endif
                            <li class="nav-item  dropdown ">
                                <a class="nav-link  dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                                    {{Auth::user()->nombre}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{asset('perfil')}}">Perfil</a>
                                    <a class="dropdown-item" href="{{asset('/')}}">Mi Casa</a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{asset('logout')}}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Salir</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>

        </nav>
    </header>

    <div class="space__header"></div>

    @yield('content')



    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('mdb.js')}}"></script>

    @yield('script_js')
</body>
</html>
