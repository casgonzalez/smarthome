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


        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:75%;
            right:40px;
            background-color:#1c2a48 !important;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            box-shadow: 2px 2px 3px #999;
        }

        .my-float{
            margin-top:13px;
        }
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
                 </div>
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

@stop
