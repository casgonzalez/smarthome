@extends('layouts.layout_01')

@section('title','Home')

@section('style_css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                                    <img src="https://www.flaticon.es/svg/static/icons/svg/704/704845.svg" style="width: 30px; height: 30px;" id="imageTemperature" alt="">
                                </div>
                                <div class="card-body text-center">
                                    <span  style="font-size: 40px;"  class="text-uppercase text-bold">{{$lastTemp->temperatura}} °C</span>
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
                                    <span id="humidity" style="font-size: 40px;"  class="text-uppercase text-bold">{{$lastHumedad->valor}} %</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div id="loading-overlay">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin:auto;display:block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#FA0A05" stroke="none"><animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 51;360 50 51"></animateTransform></path></svg>
        </div>

        <div class="space__header"></div>

        <div class="row wrapper">

             <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                 <div class="card no-padding">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <span class="text-uppercase">camara en vivo</span>
                         <img style="width: 25px; height: 25px;" src="{{asset('imagenes/actuadores/live.png')}}" alt="">
                     </div>
                     <div class="card-body no-padding content__camera">
                     </div>
                 </div>
             </div>

            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div class="card no-padding">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="text-uppercase">Hola {{Auth::user()->nombre}}</span>
                        <img style="width: 25px; border-radius: 50%; height: 25px;" src="{{asset(Auth::user()->urlFotoPerfil)}}" alt="">
                    </div>
                    <div class="card-body content__camera overflor-y">
                        <div class="alarmas" >
                            @foreach($alarmas as $alarma)
                                <div class="" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                                    <span>
                                         @switch($alarma->actuator_id)
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
                                        {{$alarma->actuator}}  @if ($alarma->next_state == 0) Se apagara @else Se prendera @endif  {{$alarma->timeRemaining()}}
                                    </span>
                                    <form action="{{asset('/alarma/'.$alarma->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                <hr>
                            @endforeach
                        </div>
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
        <div class="row wrapper">
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header">{{$luzInterna->actuator}}</div>
                    <div class="card-body text-center">
                        <input type="checkbox" id="luzInterna" onchange="onChangeLuzInterna(event,'{{$luzInterna->id}}')" @if($luzInterna->state == 1) checked @endif data-toggle="toggle">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{$luzExterna->actuator}}
                        <i class="fas fa-clock" data-toggle="modal" data-target=".modalLuzExternaAlarma" style="cursor:pointer;"></i>
                    </div>
                    <div class="card-body text-center">
                        <input type="checkbox" id="luzExterna" onchange="onChangeLuzExterna(event,'{{$luzExterna->id}}')" @if($luzExterna->state == 1) checked @endif  data-toggle="toggle">
                    </div>
                </div>
            </div>
        </div>
        <div class="row wrapper">
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header">{{$luzCuarto->actuator}}</div>
                    <div class="card-body text-center">

                        <input type="checkbox" id="luzCuarto" onchange="onChangeLuzCuarto(event,'{{$luzCuarto->id}}')" @if($luzCuarto->state == 1) checked @endif data-toggle="toggle">

                        <input type="range" id="rangoLuzCuarto" value="{{$luzCuarto->state}}" min="0" max="3" class="form-control @if($luzCuarto->state != 1) blocked @endif">
                        <span class="badge badge-secondary @if($luzCuarto->state != 1) blocked @endif" id="state_luz_cuarto"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header  d-flex justify-content-between align-items-center">
                        {{$ventilador->actuator}}
                        <i class="fas fa-clock" data-toggle="modal" data-target=".modalVentiladorAlarma" style="cursor:pointer;"></i>
                    </div>
                    <div class="card-body text-center">
                        <input type="checkbox" id="ventilador" onchange="onChangeVentilador(event,'{{$ventilador->id}}')" @if($ventilador->state == 1) checked @endif data-toggle="toggle">

                        <input type="range" id="rangoVentilador" value="{{$ventilador->state}}" min="0" max="3" class="form-control @if($ventilador->state != 1) blocked @endif">
                        <span class="badge badge-secondary @if($ventilador->state != 1) blocked @endif" id="state_ventilador"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row wrapper">
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center ">
                        {{$clima->actuator}}
                        <i class="fas fa-clock" data-toggle="modal" data-target=".modalClimaAlarma" style="cursor:pointer;"></i>
                    </div>
                    <div class="card-body text-center">
                        <input type="checkbox" id="clima" onchange="onChangeClima(event,'{{$clima->id}}')" @if($clima->state == 1) checked @endif data-toggle="toggle">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{$porton->actuator}}
                        <a href="{{asset('forzar_puerta')}}" class="btn btn-danger btn-sm">
                            <i class="fa fa-clock-open"></i>
                            Forzar
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <input type="checkbox" id="porton" onchange="onChangePorton(event,'{{$porton->id}}')" @if($porton->state == 1) checked @endif data-toggle="toggle">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--CLIMA MODAL-->
    <form action="{{asset('alarma/'.$clima->id)}}" method="POST">
        @csrf
        <div class="modal fade modalClimaAlarma" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>Programar tu clima</span>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <select name="next_state" id="" class="form-control form-control-lg">
                                <option value="" selected>Selecciona un estado</option>
                                <option value="0">1.Apagar</option>
                                <option value="1">2.Encender</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="datetime-local" name="time" class="form-control-lg form-control">
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Ventilador MODAL-->
    <form action="{{asset('alarma/'.$ventilador->id)}}" method="POST">
        @csrf
        <div class="modal fade modalVentiladorAlarma" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>Programar tu ventilador</span>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <select name="next_state" id="" class="form-control form-control-lg">
                                <option value="" selected>Selecciona un estado</option>
                                <option value="0">1.Apagar</option>
                                <option value="1">2.Encender</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="datetime-local" name="time" class="form-control-lg form-control">
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!--Luz Externa MODAL-->
    <form action="{{asset('alarma/'.$luzExterna->id)}}" method="POST">
        @csrf
        <div class="modal fade modalLuzExternaAlarma" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <span>Programar tu Luz Externa</span>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <select name="next_state" id="" class="form-control form-control-lg">
                                <option value="" selected>Selecciona un estado</option>
                                <option value="0">1.Apagar</option>
                                <option value="1">2.Encender</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="datetime-local" name="time" class="form-control-lg form-control">
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



@stop

@section('script_js')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js'></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <script>

        $('#luzInterna').bootstrapToggle({
            on: 'Prendido',
            off: 'Apagado'
        });

        $('#luzExterna').bootstrapToggle({
            on: 'Prendido',
            off: 'Apagado'
        });

        $('#luzCuarto').bootstrapToggle({
            on: 'Prendido',
            off: 'Apagado'
        });

        $('#clima').bootstrapToggle({
            on: 'Encendido',
            off: 'Apagado'
        });

        $('#ventilador').bootstrapToggle({
            on: 'Encendido',
            off: 'Apagado'
        });

        $('#clima').bootstrapToggle({
            on: 'Encendido',
            off: 'Apagado'
        });

        $('#porton').bootstrapToggle({
            on: 'Abierto',
            off: 'Cerrado'
        });

        var rangoLuzCuarto = document.getElementById("rangoLuzCuarto");
        var stateLuzCuarto = document.getElementById("state_luz_cuarto");
        rangoLuzCuarto.addEventListener("change",function (event) {

            let state = event.target.value;

            switch (state) {
                case '0': {
                    // apagado
                    $('#luzCuarto').bootstrapToggle('off');
                    rangoLuzCuarto.value = 0;
                    rangoLuzCuarto.classList.add('blocked');

                    break;

                }

                case '1': {
                    // baja
                    changeState(state,3,'Luz del cuarto tiene una Iluminación baja')
                    stateLuzCuarto.innerHTML = `Iluminación Baja (${state})`;
                    break;

                }

                case '2': {
                    // media
                    changeState(state,3,'Luz del cuarto tiene una Iluminación media')
                    stateLuzCuarto.innerHTML = `Iluminación Media (${state})`;
                    break;

                }
                case '3': {
                    // alta
                    changeState(state,3,'Luz del cuarto tiene una aluminación Alta')
                    stateLuzCuarto.innerHTML = `Iluminación Alta (${state})`;
                    break;

                }
            }


        });

        var rangoVentilador = document.getElementById("rangoVentilador");
        var stateVentilador = document.getElementById("state_ventilador");

        rangoVentilador.addEventListener("change",function (event){

            let state = event.target.value;

            switch (state) {
                case '0': {
                    // apagado
                    $('#ventilador').bootstrapToggle('off');

                    changeState(state, 4, 'Ventilador se a apagado');

                    rangoVentilador.value = 0;
                    stateVentilador.classList.add('blocked');

                    break;

                }

                case '1': {
                    // baja
                    changeState(state, 4, 'Ventilador Velocidad Baja')
                    stateVentilador.innerHTML = `Velocidad Baja (${state})`;
                    break;

                }

                case '2': {
                    // media
                    changeState(state, 4, 'Ventilador Velocidad Media')
                    stateVentilador.innerHTML = `Velocidad Media (${state})`;
                    break;

                }
                case '3': {
                    // alta
                    changeState(state, 4, 'Ventilador Velocidad Alta')
                    stateVentilador.innerHTML = `Velocidad Alta (${state})`;
                    break;

                }
            }
        });

        function onChangeLuzInterna(event,idActuator) {

            let luzInterna = document.getElementById("luzInterna");
            let isChecked  = luzInterna.checked;

            if (isChecked) {
                let valueNt = document.getElementById("notificacionCount");
                changeState(1,idActuator,'Luz Interna se a prendido')
            }else{
                let valueNt = document.getElementById("notificacionCount");
                changeState(0,idActuator,'Luz Interna se a apagado')
            }
        }

        function onChangeLuzExterna(event , idActuador) {

            let luzExterna = document.getElementById("luzExterna");
            let isChecked  = luzExterna.checked;

            if (isChecked) {
                changeState(1,idActuador,'Luz Externa se a prendido')
            }else{
                changeState(0,idActuador,'Luz Externa se a apagado')
            }

        }

        function onChangeLuzCuarto(event , idActuador) {

            let luzCuarto = document.getElementById("luzCuarto");
            let isChecked  = luzCuarto.checked;

            if (isChecked) {
                changeState(1,idActuador,'Luz del cuarto se a prendido')
                rangoLuzCuarto.classList.remove('blocked');
                rangoLuzCuarto.value = 1;
                stateLuzCuarto.classList.remove('blocked');
                stateLuzCuarto.innerHTML = `Iluminación Baja (1)`;
            }else{
                changeState(0,idActuador,'Luz del cuarto se a apagado')
                rangoLuzCuarto.classList.add('blocked');
                stateLuzCuarto.classList.add('blocked');
            }
        }

        function  onChangeVentilador(event , idActuador) {

            let ventilador = document.getElementById("ventilador");
            let isChecked  = ventilador.checked;

            if (isChecked) {
                changeState(1,idActuador,'El ventilador  se a encendido')
                rangoVentilador.classList.remove('blocked');
                rangoVentilador.value = 1;
                stateVentilador.classList.remove('blocked');
                stateVentilador.innerHTML = `Velocuidad Baja (1)`;
            }else{
                changeState(0,idActuador,'El ventilador se a apagado')
                rangoVentilador.classList.add('blocked');
                stateVentilador.classList.add('blocked');
            }

        }

        function  onChangeClima(event , idActuador) {

            let clima = document.getElementById("clima");
            let isChecked  = clima.checked;

            if (isChecked) {
                changeState(1,idActuador,'El clima  se a encendido')
            }else{
                changeState(0,idActuador,'El clima se a apagado')
            }

        }

        function  onChangePorton(event , idActuador) {

            let porton = document.getElementById("porton");
            let isChecked  = porton.checked;

            if (isChecked) {
                changeState(1,idActuador,'El portón  se a abierto')
            }else{
                changeState(0,idActuador,'El portón se a cerrado')
            }

        }

        async function  changeState(state,actuator,msg) {
            show_loading();
           let endpoint = 'http://localhost:8000/actuadores?next_state='+state+'&idActuator='+actuator;

           let result = await axios.put(endpoint,{});

           hide_loading();

           toastr.success(msg);

           location.reload();
        }

        function show_loading() {
            $('html').addClass('loading-overlay-shown');
            $('#loading-overlay').fadeIn(300);
        }

        function hide_loading () {
            $('html').removeClass('loading-overlay-shown');
            $('#loading-overlay').fadeOut(300);
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

@stop
