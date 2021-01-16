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
                                    <span class="badge badge-danger nt" id="notificacionCount">{{$notificaciones->count()}}</span>
                                    Notificaciones
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="height: 300px; overflow-y: scroll;">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="" style="padding: 10px 10px;">Notificaciones</span> <br>
                                            <a href="{{asset('notificaciones')}}" style="padding: 0px 10px"><small>Ver todo</small></a>
                                        </div>

                                        <span  class="fas fa-trash" style="padding: 10px 10px; cursor: pointer"></span>
                                    </div>

                                    @foreach($notificaciones as $nt)
                                        <a class="dropdown-item" href="{{asset('perfil')}}">
                                            @switch($nt->idActuador)
                                                @case(1)
                                                    <img src="{{asset('imagenes/actuadores/luz-prendida.png')}}" style="width: 20px; height: 20px; border-radius: 100%;" alt="">
                                                @break
                                                @case (2)
                                                    <img src="{{asset('imagenes/actuadores/luz-prendida.png')}}" style="width: 20px; height: 20px; border-radius: 100%;" alt="">
                                                @break
                                                @case (3)
                                                    <img src="{{asset('imagenes/actuadores/luz-prendida.png')}}" style="width: 20px; height: 20px; border-radius: 100%;" alt="">
                                                @break
                                                @case (4)
                                                    <img src="{{asset('imagenes/actuadores/ventilador-prendido.png')}}" style="width: 20px; height: 20px; border-radius: 100%;" alt="">
                                                @break
                                                @case (5)
                                                    <img src="{{asset('imagenes/actuadores/aire-apagado.png')}}" style="width: 20px; height: 20px; border-radius: 100%;" alt="">
                                                @break
                                                @case (6)
                                                    <img src="{{asset('imagenes/actuadores/candado-apagado.png')}}" style="width: 20px; height: 20px; border-radius: 100%;" alt="">
                                                @break
                                            @endswitch
                                            {{$nt->actuator}}
                                            @switch($nt->state)
                                                @case(0)
                                                    @if($nt->actuator == 'Porton')  Se cerro @else Se apago @endif
                                                @break
                                                @case (1)
                                                    @if($nt->actuator == 'Porton')  Se abrio @else Se cerro @endif
                                                @break
                                            @endswitch

                                            ({{$nt->nombre}} ) <br>
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
    <script src="{{asset('js/mdb.js')}}"></script>


    @yield('script_js')
</body>
</html>
