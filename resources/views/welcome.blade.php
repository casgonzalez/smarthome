@extends('layouts.layout_01')

@section('title','Home')

@section('style_css')
    <style>
        .wrapper {
            background: #f5f5f5;
            padding: 20px;
        }

        .material-switch {
            display: inline-block;
            position: relative;
            width: 46px;
            height: 17px;
            margin: 6px 1px;
        }
        .material-switch .material-switch-btn {
            position: absolute;
            height: 100%;
            width: 100%;
            border-radius: 100px;
            pointer-events: none;
            opacity: 1;
            transition: background-color linear .08s;
            background: rgba(144, 144, 144, 0.2);
        }
        .material-switch .material-switch-btn:after {
            content: '';
            position: absolute;
            top: -5px;
            left: 0;
            height: 27px;
            width: 27px;
            border-radius: 50%;
            box-shadow: 0 1px 5px 0 rgba(0, 0, 0, 0.6);
            transition: -webkit-transform linear .08s, background-color linear .08s;
            transition: transform linear .08s, background-color linear .08s;
            will-change: transform;
            background-color: #909090;
            cursor: pointer;
        }
        .material-switch .material-switch-toggle {
            opacity: 0;
            position: absolute;
            margin: 0;
            z-index: -1;
            width: 0;
            height: 0;
            overflow: hidden;
            left: 0;
            pointer-events: none;
        }
        .material-switch .material-switch-toggle:checked + .material-switch-btn:after {
            transform: translateX(20px);
            background-color: #4285f4;
            box-shadow: 0 1px 5px 0 rgba(66, 133, 244, 0.6);
        }

    </style>
@stop

@section('content')

     <div class="container">

         <div class="space__header"></div>

         <div class="row wrapper">

             <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
                <div class="card no-padding">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="text-uppercase">
                            Cámara en vivo
                        </span>
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="card-body no-padding content__camera">
                        <iframe width="100%" height="100%" src="https://www.youtube-nocookie.com/embed/9QRkPXXfK90" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
             </div>
             <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                 <div class="card no-padding">
                     <div class="card-header d-flex justify-content-between align-items-center ">
                         <span class="text-uppercase">
                           Ultimas notificaciones
                        </span>
                         <i class="fas fa-bell"></i>
                     </div>
                     <div class="card-body content_notifications overflor-y"></div>
                 </div>
             </div>

         </div>

         <div class="row wrapper sensores">

             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">Programar alarmas</span>
                         <i class="fas fa-clock"></i>
                     </div>
                     <div class="card-body">
                         <form action="{{asset('alarmas')}}" method="POST" class="d-flex  text-left flex-column justify-content-center">
                             @csrf
                             <div class="form-group">
                                 <label for="">Agregar alarma</label>
                                 <input type="datetime-local" name="end_time" class="form-control-lg form-control">
                             </div>
                             <button type="submit" class="btn btn-primary">
                                 <i class="fas fa-plus-circle mr-2"></i>
                                 Agregar
                             </button>
                         </form>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">Alarmas programadas</span>
                         <i class="fas fa-tint"></i>
                     </div>
                     <div class="card-body  overflor-y">
                         <ul class="list-group">
                             @foreach($alarmas as $alarma)
                                <li class="list-group-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{$alarma->time_end}}</span>
                                </li>
                             @endforeach
                         </ul>
                     </div>
                 </div>
             </div>

         </div>

         <div class="row wrapper sensores">
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">temperatura</span>
                         <i class="fas fa-temperature-high"></i>
                     </div>
                     <div class="card-body d-flex justify-content-center align-items-center">
                         <strong style="font-size: 35px">Actualmente: <span class="text-primary">66°C</span></strong>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">Humedad</span>
                         <i class="fas fa-tint"></i>
                     </div>
                     <div class="card-body d-flex justify-content-center align-items-center">
                         <strong style="font-size: 35px">Actualmente: <span class="text-primary">20</span></strong>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row wrapper sensores">
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">Aire acondicionado</span>
                         <i id="SENSOR_ICON_aire_acondicionado" class="fas  fa-snowflake"></i>
                     </div>
                     <div class="card-body d-flex justify-content-center align-items-center">
                         <span id="SPAN_SENSOR_estado" class="mr-4 text-uppercase">Apagado</span>
                         <label class="material-switch">
                             <input id="SENSOR_aire_acondicionado" type="checkbox"  class="material-switch-toggle">
                             <span class="material-switch-btn"></span>
                         </label>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">Ventilador</span>
                         <i class="fas fa-life-ring"></i>
                     </div>
                     <div class="card-body d-flex justify-content-center align-items-center">
                         <span id="SPAN_SENSOR_estado" class="mr-4 text-uppercase">Apagado</span>
                         <label class="material-switch">
                             <input id="SENSOR_aire_acondicionado" type="checkbox"  class="material-switch-toggle">
                             <span class="material-switch-btn"></span>
                         </label>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row wrapper sensores">
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">Luz interna</span>
                         <i class="fas fa-lightbulb"></i>
                     </div>
                     <div class="card-body d-flex justify-content-center align-items-center">
                         <span id="SPAN_SENSOR_estado" class="mr-4 text-uppercase">Apagado</span>
                         <label class="material-switch">
                             <input id="SENSOR_aire_acondicionado" type="checkbox"  class="material-switch-toggle">
                             <span class="material-switch-btn"></span>
                         </label>
                     </div>
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">Luz externa</span>
                         <i class="fas fa-lightbulb"></i>
                     </div>
                     <div class="card-body d-flex justify-content-center align-items-center">
                         <span id="SPAN_SENSOR_estado" class="mr-4 text-uppercase">Apagado</span>
                         <label class="material-switch">
                             <input id="SENSOR_aire_acondicionado" type="checkbox"  class="material-switch-toggle">
                             <span class="material-switch-btn"></span>
                         </label>
                     </div>
                 </div>
             </div>
         </div>

         <div class="row wrapper sensores">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">Sistema de seguridad puerta</span>
                         <i class="fas fa-lock"></i>
                     </div>
                     <div class="card-body d-flex justify-content-center align-items-center">
                         <span id="SPAN_SENSOR_estado" class="mr-4 text-uppercase">Apagado</span>
                         <label class="material-switch">
                             <input id="SENSOR_aire_acondicionado" type="checkbox"  class="material-switch-toggle">
                             <span class="material-switch-btn"></span>
                         </label>
                     </div>
                 </div>
             </div>
         </div>

     </div>

@stop

@section('script_js')

    <script>

        SENSOR_aireAcondicionado      = document.getElementById("SENSOR_aire_acondicionado");
        SPAN_SENSOR_estado            = document.getElementById("SPAN_SENSOR_estado");
        SENSOR_ICON_aireAcondicionado = document.getElementById("SENSOR_ICON_aire_acondicionado");

        SENSOR_aireAcondicionado.addEventListener("change",()=>{

            let estadoCheck = SENSOR_aireAcondicionado.checked ? 'ENCENDIDO' : 'APAGADO';

            SPAN_SENSOR_estado.innerText = estadoCheck;

            if (estadoCheck == 'ENCENDIDO')
                SENSOR_ICON_aireAcondicionado.classList.add("text-primary")
            else
                SENSOR_ICON_aireAcondicionado.classList.remove("text-primary")
        });


    </script>

@stop
