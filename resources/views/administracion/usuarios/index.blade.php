@extends('layouts.layout_01')

@section('title','Home')

@section('style_css')
    <style>

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }
        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }
        .avatar-upload .avatar-edit input {
            display: none;
        }
        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #ffffff;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }
        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }
        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: "FontAwesome";
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }
        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #f8f8f8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }
        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

    </style>
@stop

@section('content')
    <div class="space__header"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">

                        <form action="{{asset('administracion/usuarios')}}" method="GET">
                            <div class="input-group input-group-lg box-gray">
                                <input type="text" name="like" value="{{$like}}" placeholder="Buscar usuario..." class="form-control form-control-lg " aria-label="Text input with dropdown button">
                                <div class="input-group-append">
                                    <button class="btn btn-default btn-md m-0 px-3 py-2 z-depth-0" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                        <div class="box-gray text-center">
                            <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-default">
                                <i class="fas fa-user-plus"></i>
                                Nuevo
                            </a>
                        </div>
                    </div>
                </div>
                <form action="{{asset('administracion/usuarios')}}" method="POST">
                    @csrf
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Nuevo usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Nombre Completo</label>
                                                <input type="text" class="form-control form-control-lg" name="nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" class="form-control-lg form-control" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="">Contraseña</label>
                                                <input type="password" class="form-control form-control-lg" name="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-lg mr-2" data-dismiss="modal">Cancelar</button>
                                    <button class="btn btn-lg btn-default">
                                        <i class="fas fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="space__50"></div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="tr-users">
                                    <td>
                                        <img
                                            data-toggle="modal" data-target="#modalProfile{{$user->idUsuario}}"
                                            class="avatar"
                                            style="border-radius: 100%; cursor: pointer"
                                            src="{{asset($user->urlFotoPerfil)}}" alt="">
                                    </td>
                                    <td>
                                        {{$user->nombre}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        <span class="badge p-2 text-uppercase {{$user->eliminado}}">{{$user->eliminado}}</span>
                                    </td>
                                    <td>
                                        <form action="{{asset('administracion/usuarios/'.$user->idUsuario)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button  class="btn btn-sm @if($user->eliminado == 'activo') inactivo @else activo @endif">
                                                <i class="fas   @if($user->eliminado == 'activo') fa-trash @else fa-check @endif"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                <form action="{{asset('perfil/changeProfileImage')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="idUsuario" value="{{$user->idUsuario}}">
                                    <div class="modal fade" id="modalProfile{{$user->idUsuario}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Actualiza la foto de perfil</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img
                                                        data-toggle="modal" data-target="#modalProfile{{$user->idUsuario}}"
                                                        class="avatar"
                                                        style="border-radius: 100%; cursor: pointer"
                                                        src="{{asset($user->urlFotoPerfil)}}" alt="">
                                                    {{$user->nombre}} <br> <br>
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="imageUpload" required name="profile" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview" style="background-image: url({{asset($user->urlFotoPerfil)}});">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-default">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginacion__usuarios">
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>

@stop

@section('script_js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
@stop
