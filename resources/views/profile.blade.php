@extends('layouts.layout_01')

@section('style_css')
    <style>

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 10px auto;
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


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('status_success'))
                    <div class="alert alert-success">
                        <strong>{{Session::get('status_success')}}</strong>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <form action="{{asset('perfil/changeProfileImage')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center ">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' name="profile" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload">
                                        <i class="fa fa-edit"></i>
                                    </label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url({{Auth::user()->urlFotoPerfil}});">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-upload"></i>
                                Actualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form class="" action="{{asset('administracion/usuarios/'.$user->idUsuario)}}" method="post">
                            @csrf
                            @method('put')
                            @include('administracion.usuarios.form',['profile'=>false])

                            <button type="submit" class="btn btn-sm btn-success" name="button">
                                <i class="fa fa-edit"></i>
                                Guardar
                            </button>
                        </form>
                    </div>
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
