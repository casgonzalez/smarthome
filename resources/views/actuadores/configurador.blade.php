@if($actuador->id == 1 && $actuador->estado == 1)
    @include('actuadores.iluminacion')
@endif

@if($actuador->id == 2 && $actuador->estado == 1)
    @include('actuadores.ventilador')
@endif
