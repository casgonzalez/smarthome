<div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="form-group">
            <label for="">Nombre Completo</label>
            <input type="text" required @if($profile) disabled @endif value="{{$user->nombre}}" class="form-control form-control-lg" name="nombre">
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" required @if($profile) disabled @endif value="{{$user->email}}" class="form-control-lg form-control" name="email">
        </div>
    </div>
    @if($profile == false)
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
        <div class="form-group">
            <label for="">Contraseña</label>
            <input type="password" min="8" required @if($profile) disabled @endif class="form-control form-control-lg" name="password">
        </div>
    </div>
    @endif
</div>
