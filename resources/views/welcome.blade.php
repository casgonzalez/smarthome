@extends('layouts.layout_01')

@section('title','Home')

@section('style_css')
    <style>

    </style>
@stop

@section('content')

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="text-uppercase text-bold">temperatura y humedad actual</span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-header text-uppercase d-flex justify-content-between    align-items-center">
                                    temperatura
                                    <img src="" style="width: 30px; height: 30px;" id="imageTemperature" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <span id="temperature" style="font-size: 40px;"  class="text-uppercase text-bold"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <div class="card">
                                <div class="card-header text-uppercase d-flex justify-content-between    align-items-center">
                                    humedad
                                    <img src="https://www.flaticon.es/svg/static/icons/svg/3314/3314011.svg" style="width: 30px; height: 30px;" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <span id="humidity" style="font-size: 40px;"  class="text-uppercase text-bold"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="space__header"></div>

        <div class="row wrapper">

             <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                 <div class="card no-padding">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">camara en vivo</span>
                         <img style="width: 25px; height: 25px;" src="{{asset('imagenes/actuadores/live.png')}}" alt="">
                     </div>
                     <div class="card-body no-padding content__camera">
                         <iframe width="100%" height="100%" src="https://www.youtube-nocookie.com/embed/9QRkPXXfK90" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                     </div>
                 </div>
             </div>
         </div>

        <div class="row wrapper">
             <div class="col-md-12">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                         <span class="text-uppercase text-bold">temperatura</span>
                         <img src="{{asset('imagenes/actuadores/temperatura.png')}}"  data-toggle="modal" data-target=".bd-example-modal-lg" style="width: 25px; cursor: pointer; height: 25px;" alt="">
                     </div>
                    <div class="card-body">
                        <canvas id="myChart" height="300px"></canvas>
                    </div>
                 </div>
             </div>
         </div>
        <div class="row wrapper sensores">
            @foreach($actuadores as $actuador)
                <div class="col-md-{{$actuador->tamanio}} col-lg-{{$actuador->tamanio}} col-xs-12 col-sm-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="text-uppercase">{{$actuador->actuador}}</span>
                            <img class="imgSensor" src="{{asset($actuador->icono)}}" alt="">
                        </div>
                        <div class="card-body">
                            <form action="{{asset('actuadores/actualizar_estado')}}" id="form_actuador_{{$actuador->id}}" method="POST">
                                <input type="hidden" value="{{$actuador->id}}" name="idActuador">
                                @csrf
                                @method('put')
                                <div class="d-flex justify-content-center align-items-center">

                                    <span class="text-uppercase mr-2">
                                        @if($actuador->id <5)
                                            @if($actuador->estado == 0) Apagado @else Prendido @endif
                                        @else
                                            @if($actuador->estado == 0) Cerrado @else Abierto @endif
                                        @endif
                                    </span>

                                    @include('actuadores.switch')

                                </div>
                                <div class="text-center">
                                    @if($actuador->need_configuracion)
                                        @include('actuadores.configurador')
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                 {{--<div class="col-md-{{$actuador->tamanio}} col-lg-{{$actuador->tamanio}} col-xs-12 col-sm-12">
                     <div class="card mb-3">
                         <div class="card-header d-flex justify-content-between align-items-center">
                             <span class="text-uppercase">{{$actuador->actuador}}</span>
                             <img style="width: 25px; height: 25px;" src="{{asset($actuador->icono)}}" alt="">
                         </div>
                         <div class="card-body d-flex justify-content-center align-items-center">
                             <form action="{{asset('actuadores/actualizar_estado')}}" id="form_actuador_{{$actuador->id}}" method="POST">
                                 <input type="hidden" value="{{$actuador->id}}" name="id">
                                 @csrf
                                 @method('put')
                                 <span class="mr-4 text-uppercase">
                                    @if($actuador->estado == 0) Apagado @else Prendido @endif
                                 </span>
                                 <label class="material-switch">
                                     <input @if($actuador->estado == 1) checked @endif name="state" type="checkbox" onchange="changeState('{{$actuador->id}}')" class="material-switch-toggle">
                                     <span class="material-switch-btn"></span>
                                 </label>
                                 <div class="">
                                     @if($actuador->id == 2 || $actuador->id == 4 )
                                         <input type="hidden" name="nivel" value="0">
                                         <input type="hidden" name="noChangeState" value="1">
                                         @if($actuador->estado == 1)
                                             <div class="d-flex justify-content-between align-items-center">
                                                 <input type="range" name="nivel" value="{{$actuador->nivel}}" class="form-control">
                                                 <span class="text-uppercase text-bold  ml-2"> {{$actuador->nivel}}</span>
                                             </div>
                                             <button type="submit" class="bnt btn-sm form-control btn-primary">
                                                 <i class="fas fa-check"></i>
                                             </button>
                                         @endif
                                     @endif
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>--}}
            @endforeach

        </div>

    </div>

@stop

@section('script_js')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js'></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>

        function changeState(idActuador) {
            let idForm = document.getElementById(`form_actuador_${idActuador}`);
            idForm.submit();
        }

    </script>

    <script>

        var ctx = document.getElementById("myChart").getContext('2d');


        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    @foreach($temperaturas as $temperatura)
                        "{{$temperatura['fecha']}}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Temperatura °C', // Name the series
                    data: [
                        @foreach($temperaturas as $temperatura)
                            "{{$temperatura['temperatura']}}",
                        @endforeach
                    ], // Specify the data values array
                    fill: false,
                    borderColor: '#2196f3', // Add custom color border (Line)
                    backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]},
            options: {
                responsive: true, // Instruct chart js to respond nicely.
                maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });

    </script>

    <script>

        var endpointWather = "https://api.darksky.net/forecast/8f05b9be093e0cbfcd6d645a5eb8a0af/16.7597,-93.1131?units=si&callback=?";

         function getWather () {
             $.getJSON(endpointWather,(report)=>{

                 let currently = report.currently;

                 let temperature = currently.temperature;
                 let humidity    = currently.humidity;

                 let temperatureDOM = document.getElementById('temperature');
                 let humidityDOM    = document.getElementById('humidity');

                 temperatureDOM.innerText = temperature+' °C';
                 humidityDOM.innerText    = humidity+" %";

                 let imageTemperatureDOM = document.getElementById("imageTemperature");

                 if (temperature >= 27) {
                     imageTemperatureDOM.setAttribute('src','https://www.flaticon.es/svg/static/icons/svg/869/869869.svg');
                 }

                 if (temperature < 27) {
                     imageTemperatureDOM.setAttribute('src','https://www.flaticon.es/svg/static/icons/svg/704/704845.svg');
                 }

             });
         }

        getWather();


    </script>

    <script>

        let inputRangoVentilador  = document.getElementById("rangoVentilador");
        let inputRangoIluminacion = document.getElementById("rangoIluminacion");

        inputRangoVentilador.addEventListener("change",(event)=>{
            let value = event.target.value;
            document.getElementById("rangeVentilador").innerText = value;
        });

        inputRangoIluminacion.addEventListener("change",(event)=>{
            let value = event.target.value;
            document.getElementById("rangeIluminacion").innerText = value;
        });
    </script>

@stop

