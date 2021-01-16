@extends('layouts.layout_01')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8    ">
            <div class="card mb-5">
                <div class="card-header">
                    <span>Todas las notificaciones ({{$nts->count()}})</span>
                </div>
                <div class="card-body overflor-y" style="height: 500px;">
                    @foreach($nts as $nt)
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
                            {{$nt->created_at}} <br>
                                <form action="">
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
                                </form>
                        </a>
                        <div class="divider"></div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@stop
