@extends('layouts.layout_01')

@section('title','Home')



@section('content')
    <div class="space__header"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">

                        @if(Session::has('status_warning'))
                            <div class="alert alert-warning">
                                {{Session::get('status_warning')}}
                            </div>
                        @endif

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
                    @include('administracion.usuarios.modal_create')
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
                                        <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-{{$user->idUsuario}}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{asset('administracion/usuarios/'.$user->idUsuario)}}" style="display: inline-block;" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button  class="btn btn-sm @if($user->eliminado == 'activo') inactivo @else activo @endif">
                                                <i class="fas   @if($user->eliminado == 'activo') fa-trash @else fa-check @endif"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                <form action="{{asset('administracion/usuarios/'.$user->idUsuario)}}" method="POST">
                                    @csrf
                                    @method('put')
                                    @include('administracion.usuarios.modal_edit',['idUser'=>$user->idUsuario])
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

