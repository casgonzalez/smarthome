<span id="rangeVentilador">{{$actuador->configuracion}}</span>
<input type="range" name="configuracion" id="rangoVentilador" value='{{$actuador->configuracion}}' min="1" max="3"  autocomplete="off">
<br>
<span class="text--btm">Velocidad ({{$actuador->configuracion}})</span> <br>


<button class="btn btn-primary btn-sm form-control" style="width: 30%; margin: auto;" type="submit">
    <i class="fas fa-check"></i>
</button>
