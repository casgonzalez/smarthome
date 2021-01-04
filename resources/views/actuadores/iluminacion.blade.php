<span id="rangeIluminacion">{{$actuador->configuracion}}</span>
<input type="range" id="rangoIluminacion" name="configuracion" value='{{$actuador->configuracion}}' min="1" max="3"  autocomplete="off">
<br>
<span class="text--btm">Iluminación ({{$actuador->configuracion}})</span>
<br>
<button class="btn btn-primary btn-sm form-control" style="width: 30%; margin: auto;" type="submit">
    <i class="fas fa-check"></i>
</button>
