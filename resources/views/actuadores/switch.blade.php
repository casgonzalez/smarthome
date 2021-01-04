<label class="material-switch">

    <input
        @if($actuador->estado == 1) checked @endif
        name="estado"
        type="checkbox"
        onchange="changeState('{{$actuador->id}}')"
        class="material-switch-toggle">

    <span class="material-switch-btn"></span>

</label>
