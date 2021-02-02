<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="form-group">
            <label for="">Nombre Completo</label>
            <input type="text" required @if($profile) disabled @endif value="{{$user->nombre == null ? old('nombre') : $user->nombre}}" class="form-control form-control-lg" name="nombre">
            @error('nombre')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" required @if($profile) disabled @endif value="{{$user->email == null ? old('email') : $user->email}}" class="form-control-lg form-control" name="email">
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    @if($profile == false)
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="form-group">
            <label for="">Contraseña</label>
            <input type="password" min="8"  @if($profile) disabled @endif class="form-control form-control-lg" name="password">
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
    @endif
</div>
